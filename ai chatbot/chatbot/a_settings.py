# (A) LOAD MODULES
import os, torch

# (B) MODEL
# hugging face url path, or model file inside models/
model_name = "TheBloke/vicuna-7B-v1.5-GPTQ"
#model_name = "llama-2-7b.Q5_K_M.gguf"

# (C) AUTO - PATH
path_base = os.path.dirname(os.path.realpath(__file__))
path_models = os.path.join(path_base, "models")
path_db = os.path.join(path_base, "db")
path_docs = os.path.join(path_base, "docs")

# (D) LLAMA CPP
if os.path.isfile(os.path.join(path_models, model_name)):
  model_file = os.path.join(path_models, model_name)
  model_args = {
    "max_tokens" : 2000,
    "temperature" : 0.7,
    "top_k" : 40,
    "top_p" : 1,
    "n_gpu_layers" : 40,
    "n_batch" : 512,
    "streaming" : False,
    "verbose" : False
  }

# (E) HF TRANSFORMER
else:
  os.environ["HF_HUB_DISABLE_SYMLINKS_WARNING"] = "true"
  os.environ["TRANSFORMERS_CACHE"] = path_models
  model_args = {
    "do_sample" : True,
    "max_new_tokens" : 2000,
    "batch_size" : 1,
    "temperature" : 0.7,
    "top_k" : 40,
    "top_p" : 1,
    "num_return_sequences" : 1
  }

# (F) AUTO - CPU OR GPU
if not any((torch.cuda.is_available(), torch.backends.mps.is_available())):
  gpu = False
else:
  gpu = True

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

# (J) PROMPT TEMPLATE
prompt_template = """SYSTEM: Use the following context section and only that context to answer the question at the end. Do not use your internal knowledge. If you don't know the answer, just say that you don't know, don't try to make up an answer.
CONTEXT: {context}
USER: {question}
ANSWER:"""

# (K) HTTP ENDPOINT
http_allow = ["http://localhost"]
http_host = "localhost"
http_port = 8008

# (L) JWT
jwt_algo = ""
jwt_secret = ""