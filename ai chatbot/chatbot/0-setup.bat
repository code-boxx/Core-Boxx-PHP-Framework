@echo off
php 0-setup.php
virtualenv venv
call venv\Scripts\activate
pip install langchain transformers optimum auto-gptq chromadb InstructorEmbedding sentence_transformers Flask pyjwt
if "%1"=="CPU" (
  pip install torch torchvision torchaudio --force-reinstall
  set FORCE_CMAKE=1
  set CMAKE_ARGS=-DLLAMA_CUBLAS=OFF
) else (
  pip install torch torchvision torchaudio --force-reinstall --index-url https://download.pytorch.org/whl/cu117
  set FORCE_CMAKE=1
  set CMAKE_ARGS=-DLLAMA_CUBLAS=ON
)
pip install --no-cache-dir --upgrade --force-reinstall llama-cpp-python
python b_create.py
if "%1"=="CPU" (
  echo "Install complete - Please download your own model before running 2-bot.bat"
) else (
  python d_bot.py
)