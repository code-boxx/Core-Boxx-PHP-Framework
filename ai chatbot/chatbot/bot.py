# (A) LOAD SETTINGS & MODULES
import settings as set
from flask import Flask, Response, request
import torch, jwt
from transformers import AutoTokenizer, AutoModelForCausalLM, pipeline
from langchain import PromptTemplate, HuggingFacePipeline
from langchain.vectorstores import Chroma
from langchain.embeddings import HuggingFaceEmbeddings
from langchain.chains import RetrievalQA

# (B) TOKENIZER + MODEL + DATABASE
tokenizer = AutoTokenizer.from_pretrained(set.model_name)
model = AutoModelForCausalLM.from_pretrained(
  set.model_name,
  torch_dtype = torch.float16,
  device_map = "auto"
)
db = Chroma(
  persist_directory = set.path_db,
  embedding_function = HuggingFaceEmbeddings()
)

# (C) PIPE + CHAIN
pipe = pipeline(
  task = "text-generation",
  model = model,
  tokenizer = tokenizer,
  eos_token_id = tokenizer.eos_token_id,
  do_sample = set.model_sample,
  max_new_tokens = set.model_max_tokens,
  batch_size = set.model_batch_size,
  temperature = set.model_temperature,
  top_k = set.model_top_k,
  top_p = set.model_top_p,
  num_return_sequences = set.model_sequences
)
chain = RetrievalQA.from_chain_type(
  chain_type = set.chain_type,
  llm = HuggingFacePipeline(pipeline = pipe),
  retriever = db.as_retriever(search_kwargs = {"k": set.chain_kwargs}),
  chain_type_kwargs = {
    "prompt": PromptTemplate (
      template = set.prompt_template,
      input_variables = ["question", "context"]
    )
  },
  return_source_documents = set.chain_source,
  verbose = set.chain_verbose
)

""" @TODO - ENABLE THIS TO OPEN FOR REGISTERED USERS ONLY
# (D) VERIFY USER
def jwtVerify(cookies):
  try:
    token = jwt.decode(
      jwt = cookies.get("cbsess"),
      key = set.jwt_secret,
      audience = set.http_host,
      algorithms = [set.jwt_algo]
    )
    # DO WHATEVER YOU WANT WITH THE DECODED USER TOKEN
    # print(token)
    return True
  except Exception as error:
    # print(error)
    return False
"""

# (E) FLASK
app = Flask(__name__)
@app.route("/", methods = ["POST"])
def bot():
  # (E1) CORS
  if "HTTP_ORIGIN" in request.environ and request.environ["HTTP_ORIGIN"] in set.http_allow:
    # (E1-1) ALLOW ONLY REGISTERED USERS
    """ @TODO - ENABLE THIS TO OPEN FOR REGISTERED USERS ONLY
    if jwtVerify(request.cookies) is False:
      return Response("Not Allowed", status = 405)
    """

    # (E1-2) ANSWER THE QUESTION
    data = dict(request.form)
    if "query" in data:
      ans = chain(data["query"])
      ans = ans["result"]
    else:
      ans = "Where's the question, yo?"
    response = Response(ans, status = 200)
    response.headers.add("Access-Control-Allow-Origin", request.environ["HTTP_ORIGIN"] )
    response.headers.add("Access-Control-Allow-Credentials", "true")

  # (E2) ORIGIN NOT ALLOWED
  else:
    response = Response("Not Allowed", status = 405)
  return response

# (F) GO!
if __name__ == "__main__":
  app.run(
    host = set.http_host,
    port = set.http_port
  )