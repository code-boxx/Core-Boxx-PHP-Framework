## CORE BOXX
Core Boxx is a lightweight PHP modular development framework. The whole idea is not to be another overly bloated framework with tons of unused features. So it is built around the idea of modularity, load only what you need. It is more like “predefined system modules you can expand on”, rather than a full-fledged framework.
<br><br>


## QUICK START & DOCUMENTATION
1) Edit `lib/CORE-config.php`. Change `HOST_BASE` (A) and the database settings (B) to your own.
2) Create a dummy database for your project. If you don’t need the use of a database, open `lib/CORE-go.php` and remove `$_CORE->load("DB")`.
3) Access `index.php` in your browser, this will generate the necessary `.htaccess` and `api/.htaccess` files.
4) Open `index.php` and remove the marked section.

Done! You now have a working basic framework. Please visit https://code-boxx.com/core-boxx-php-rapid-development-framework/ for more for the full documentation!
<br><br>


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

