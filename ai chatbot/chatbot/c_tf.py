# (A) LOAD SETTINGS & MODULES
import a_settings as set
import torch, psutil
from transformers import AutoConfig, AutoModelForCausalLM, AutoTokenizer, pipeline
from accelerate import infer_auto_device_map, init_empty_weights

# (B) HELPER - AUTO MAX MEMORY CALCULATION
# credits : https://github.com/oobabooga/text-generation-webui/blob/main/modules/models.py
def max_mem():
  # (B1) GPU MEMORY
  total = (torch.cuda.get_device_properties(0).total_memory / (1024 * 1024))
  suggestion = round((total - 1000) / 1000) * 1000
  if total - suggestion < 800:
    suggestion -= 1000
  suggestion = int(round(suggestion / 1000))
  max = { 0 : f"{suggestion}GiB" }

  # (B2) CPU MEMORY
  total = (psutil.virtual_memory().available / (1024 * 1024))
  suggestion = round((total - 1000) / 1000) * 1000
  if total - suggestion < 800:
    suggestion -= 1000
  suggestion = int(round(suggestion / 1000))
  max["cpu"] = f"{suggestion}GiB"

  # (B3) RETURN CALCULATED MEMORY
  return max

# (C) LOAD MODEL
# (C1) INIT PARAMS
params = {
  "low_cpu_mem_usage": True,
  "device_map" : "auto"
}

# (C2) CPU ONLY
if not any((torch.cuda.is_available(), torch.backends.mps.is_available())):
  params["torch_dtype"] = torch.float32

# (C3) GPU ACCELERATED
else:
  config = AutoConfig.from_pretrained(set.model_name)
  with init_empty_weights():
    model = AutoModelForCausalLM.from_config(config)
  model.tie_weights()
  params["device_map"] = infer_auto_device_map(
    model,
    dtype = config.torch_dtype,
    max_memory = max_mem(),
    no_split_module_classes = model._no_split_modules
  )

# (C4) LOAD MODEL
model = AutoModelForCausalLM.from_pretrained(set.model_name, **params)

# (D) PIPE
pipe = pipeline(
  task = "text-generation",
  model = model,
  tokenizer = AutoTokenizer.from_pretrained(set.model_name),
  ** set.model_args
)