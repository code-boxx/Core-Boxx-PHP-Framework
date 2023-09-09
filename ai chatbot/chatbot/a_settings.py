# (A) PATH
import os
path_base = os.path.dirname(os.path.realpath(__file__))
path_models = os.path.join(path_base, "models")
path_db = os.path.join(path_base, "db")
path_docs = os.path.join(path_base, "docs")

# (B) ENVIRONMENT VARIABLES
os.environ["HF_HUB_DISABLE_SYMLINKS_WARNING"] = "true"
os.environ["TRANSFORMERS_CACHE"] = path_models

# (C) MODEL SETTINGS
model_name = "TheBloke/vicuna-7B-v1.5-GPTQ"
model_args = {
  "do_sample" : True,
  "max_new_tokens" : 3000,
  "batch_size" : 1,
  "temperature" : 0.7,
  "top_k" : 40,
  "top_p" : 1,
  "num_return_sequences" : 1
}

# (D) CHAIN SETTINGS
chain_args = {
  "chain_type" : "stuff",
  "return_source_documents" : True,
  "verbose" : True
}

# (E) PROMPT TEMPLATE
prompt_template = """SYSTEM: Use the following context section and only that context to answer the question at the end. Do not use your internal knowledge. If you don't know the answer, just say that you don't know, don't try to make up an answer.
CONTEXT: {context}
USER: {question}
ANSWER:"""

# (F) DATABASE - DOCUMENT SPLITTER
db_split = {
  "chunk_size" : 512,
  "chunk_overlap" : 30
}

# (G) HTTP ENDPOINT
http_allow = ["http://localhost"]
http_host = "localhost"
http_port = 8008

# (H) JWT
jwt_algo = ""
jwt_secret = ""