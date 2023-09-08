# (A) PATHS
import os
path_base = os.path.dirname(os.path.realpath(__file__))
path_models = os.path.join(path_base, "models")
path_db = os.path.join(path_base, "db")
path_docs = os.path.join(path_base, "docs")
os.environ["TRANSFORMERS_CACHE"] = path_models

# (B) MODEL
model_name = "TheBloke/Wizard-Vicuna-7B-Uncensored-GPTQ"
model_sample = True
model_max_tokens = 1024
model_batch_size = 1
model_temperature = 0.7
model_top_p = 1
model_top_k = 40
model_sequences = 1

# (C) PROMPT TEMPLATE
prompt_template = """SYSTEM: Use the following context section and only that context to answer the question at the end. Do not use your internal knowledge. If you don't know the answer, just say that you don't know, don't try to make up an answer.
CONTEXT: {context}
USER: {question}
ANSWER:"""

# (D) CHAIN
chain_verbose = True
chain_type = "stuff"
chain_kwargs = 4
chain_source = True

# (E) DATABASE
doc_chunks = 512
doc_overlap = 30

# (F) HTTP ENDPOINT
http_allow = ["http://localhost"]
http_host = "localhost"
http_port = 8008

# (G) JWT
jwt_algo = ""
jwt_secret = ""