# (A) MODEL
# hugging face url path, or model file inside models/
#model_name = "TheBloke/vicuna-7B-v1.5-GPTQ"
model_name = "llama-2-7b-chat.Q5_K_M.gguf"

# (B) AUTO - PATH
import os
path_base = os.path.dirname(os.path.realpath(__file__))
path_models = os.path.join(path_base, "models")
path_db = os.path.join(path_base, "db")
path_docs = os.path.join(path_base, "docs")

# (C) AUTO - CPU OR GPU
import torch
if not any((torch.cuda.is_available(), torch.backends.mps.is_available())):
  gpu = False
else:
  gpu = True

# (D) LLAMA CPP
if os.path.isfile(os.path.join(path_models, model_name)):
  # (D1) LLAMA MODEL FILE
  model_file = os.path.join(path_models, model_name)

  # (D2) LLAMA MODEL SETTINGS
  # https://api.python.langchain.com/en/latest/llms/langchain.llms.llamacpp.LlamaCpp.html
  # FACTUAL
  model_args = {
    "repeat_penalty" : 1.176,
    "temperature" : 0.7,
    "top_k" : 40,
    "top_p" : 0.1,
    "n_ctx" : 3000,
    "max_tokens" : 3000,
    "n_gpu_layers" : 40,
    "n_batch" : 512,
    "streaming" : False,
    "verbose" : False
  }
  """ CREATIVE
  "repeat_penalty" : 1.1,
  "temperature" : 0.75,
  "top_k" : 0,
  "top_p" : 0.7,
  """

# (E) HF TRANSFORMER
else:
  # (E1) TRANSFORMER ENVIRONMENT VARIABLES
  os.environ["HF_HUB_DISABLE_SYMLINKS_WARNING"] = "true"
  os.environ["TRANSFORMERS_CACHE"] = path_models

  # (E2) MODEL VARIABLES
  # https://huggingface.co/docs/transformers/main_classes/text_generation
  model_args = {
    "do_sample" : True,
    "temperature" : 0.7,
    "top_k" : 40,
    "top_p" : 1,
    "max_new_tokens" : 3000
  }

# (F) PROMPT TEMPLATE
prompt_template = """SYSTEM: Use the following context section and only that context to answer the question at the end. Do not use your internal knowledge. If you don't know the answer, just say that you don't know, don't try to make up an answer.
CONTEXT: {context}
USER: {question}
ANSWER:"""

# (G) EMBEDDING
embed_args = {
  "model_name" : "hkunlp/instructor-xl", 
  "model_kwargs" : { "device": "cuda" if gpu else "cpu" }
}

# (H) DB - DOCUMENT SPILTTER
db_split = {
  "chunk_size" : 512,
  "chunk_overlap" : 30
}

# (I) CHAIN SETTINGS
chain_args = {
  "chain_type" : "stuff",
  "return_source_documents" : True,
  "verbose" : True
}

# (J) HTTP ENDPOINT
http_allow = ["http://localhost"]
http_host = "localhost"
http_port = 8008

# (K) JWT
jwt_algo = ""
jwt_secret = ""