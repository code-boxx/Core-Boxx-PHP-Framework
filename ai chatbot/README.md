## CORE BOXX AI CHATBOT MODULE
https://code-boxx.com/core-boxx-ai-chatbot/

## REQUIREMENTS
* [Core Boxx](https://github.com/code-boxx/Core-Boxx-PHP-Framework/tree/main/core)
* [Python](https://www.python.org/) At the time of writing, 3.9~3.10 works fine.
* [Microsoft C++ Build Tools](https://visualstudio.microsoft.com/downloads/?q=build+tools)
* A decent graphics card. Even if you tweak and run with CPU-only, it will be painfully slow...

## INSTALLATION
* Copy/unzip this module into your existing Core Boxx project folder.
* Put documents you want the AI to "learn" into `chatbot/docs`, accepted file types - `csv pdf txt epub html md odt doc docx ppt pptx`.
* Run `0-setup.bat` (Windows) `0-setup.sh` (Linux) - *BE WARNED, SEVERAL GIGABYTES WORTH OF DOWNLOAD!*
* Access `http://your-site.com/ai/` for the demo.

## NOTES
* To rebuild the documents database, simply add/remove documents from `chatbot/docs` and run `1-create.bat / 1-create.sh`.
* To launch the bot, simply run `2-bot.bat / 2-bot.sh`.

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