php 0-setup.php
virtualenv venv
source "venv/bin/activate"
pip install langchain transformers optimum auto-gptq chromadb InstructorEmbedding sentence_transformers Flask pyjwt
if [[ $1 == "CPU" ]]
then
  pip install torch torchvision torchaudio --force-reinstall --index-url https://download.pytorch.org/whl/cpu
  pip install llama-cpp-python
else
  pip install torch torchvision torchaudio --force-reinstall
  CMAKE_ARGS="-DLLAMA_CUBLAS=on" FORCE_CMAKE=1 pip install llama-cpp-python
fi
python b_create.py
if [[ $1 == "CPU" ]]
then
  echo "Install complete - Please download your own model before running 2-bot.bat"
else
  python d_bot.py