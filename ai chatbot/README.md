## CORE BOXX AI CHATBOT MODULE
https://code-boxx.com/core-boxx-ai-chatbot/

## REQUIREMENTS
* [Core Boxx](https://github.com/code-boxx/Core-Boxx-PHP-Framework/tree/main/core)
* [Python](https://www.python.org/) At the time of writing, 3.9~3.10 works fine.
* [Microsoft C++ Build Tools](https://visualstudio.microsoft.com/downloads/?q=build+tools)
* [CMake](https://cmake.org/)
* [Nvidia CUDA Toolkit](https://developer.nvidia.com/cuda-toolkit) - If you have an Nvidia graphics card.

## RECOMMENDED
* An Nvidia graphics card with at least 8GB VRAM is highly recommended.
* You can TRY to run on CPU-only, but it is painfully slow.

## INSTALLATION
* Copy/unzip this module into your existing Core Boxx project folder.
* Put documents you want the AI to "learn" into `chatbot/docs`, accepted file types - `csv pdf txt epub html md odt doc docx ppt pptx`.
* Start install - *BE WARNED, SEVERAL GIGABYTES WORTH OF DOWNLOAD!*
  * GPU - Run `0-setup.bat` (Windows) `0-setup.sh` (Linux).
  * CPU - Run `0-setup.bat CPU` (Windows) `0-setup.sh CPU` (Linux). 
* You will need to [choose and download an AI model](https://code-boxx.com/core-boxx-ai-chatbot/#sec-choose).
* Run `2-bot.bat 2-bot.sh`, access `http://your-site.com/ai/` for the demo.

## REBUILD THE DATEBASE
* Simply add/remove documents from `chatbot/docs`.
* Run `1-create.bat / 1-create.sh`.

## LICENSE
Copyright by Code Boxx

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.