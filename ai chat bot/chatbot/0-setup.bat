php 0-setup.php
virtualenv venv
call venv\Scripts\activate
pip install langchain transformers optimum auto-gptq chromadb sentence_transformers Flask
if "%1"=="GPU" (
  pip install torch torchvision torchaudio --force-reinstall --index-url https://download.pytorch.org/whl/cu117
) else (
  pip install torch torchvision torchaudio --force-reinstall
)
python create.py
python bot.py