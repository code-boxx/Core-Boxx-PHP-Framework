## CORE BOXX AI CHATBOT MODULE
https://code-boxx.com/core-boxx-ai-chatbot/

## REQUIREMENTS
* [Core Boxx](https://github.com/code-boxx/Core-Boxx-PHP-Framework/tree/main/core)
* [Python](https://www.python.org/) At the time of writing, 3.9~3.10 works fine.
* [Microsoft C++ Build Tools](https://visualstudio.microsoft.com/downloads/?q=build+tools)

## INSTALLATION
This is a "summarized guide". Check out the [official Core Boxx AI ChatBot](https://code-boxx.com/core-boxx-ai-chatbot/) page if you need more details.

* Copy/unzip this module into your existing Core Boxx project folder.
* Choose a model from [Hugging Face](https://huggingface.co/models?pipeline_tag=text-generation&sort=trending). Edit `chatbot/settings.py`, paste the URL suffix into `model_name`.
* Put your documents into `chatbot/docs`.
* Run setup - *BE WARNED, GIGABYTES WORTH OF DOWNLOAD!*
  * Windows - Run `chatbot/0-setup.bat` for "CPU only", and `chatbot/0-setup.bat GPU` for "GPU accelerated".
  * Linux - Run `chatbot/0-setup.sh` for "CPU only", and `chatbot/0-setup.sh GPU` for "GPU accelerated".
* Access `http://your-site.com/ai/` for the demo.

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