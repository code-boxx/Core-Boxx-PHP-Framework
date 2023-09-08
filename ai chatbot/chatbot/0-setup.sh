php 0-setup.php $1
virtualenv venv
source "venv/bin/activate"
pip install langchain transformers optimum auto-gptq chromadb sentence_transformers Flask pyjwt
if [[ $1 == "GPU" ]]
then
  pip3 install torch torchvision torchaudio --force-reinstall
else
  pip3 install torch torchvision torchaudio --force-reinstall --index-url https://download.pytorch.org/whl/cpu
fi
python create.py
python bot.py