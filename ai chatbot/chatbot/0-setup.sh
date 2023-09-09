php 0-setup.php
virtualenv venv
source "venv/bin/activate"
pip install langchain transformers optimum auto-gptq chromadb sentence_transformers Flask pyjwt
if [[ $1 == "CPU" ]]
then
  pip install torch torchvision torchaudio --force-reinstall --index-url https://download.pytorch.org/whl/cpu
else
  pip install torch torchvision torchaudio --force-reinstall
fi
python b_create.py
python d_bot.py