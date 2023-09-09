php 0-setup.php
virtualenv venv
call venv\Scripts\activate
pip install langchain transformers optimum auto-gptq chromadb sentence_transformers Flask pyjwt
if "%1"=="CPU" (
  pip install torch torchvision torchaudio --force-reinstall
) else (
  pip install torch torchvision torchaudio --force-reinstall --index-url https://download.pytorch.org/whl/cu117
)
python b_create.py
python d_bot.py