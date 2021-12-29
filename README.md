## CORE BOXX
Core Boxx is a lightweight PHP modular development framework. The whole idea is not to be another overly bloated framework with tons of unused features. So it is built around the idea of modularity, load only what you need. It is more like “predefined system modules you can expand on”, rather than a full-fledged framework.
<br><br>


## NOTES ON THIS REPO
1) It is painful to create a new repo for each module, so I have combined the core engine and all the modules into this one.
2) To get started, you only need to work with the `core` folder - The rest are optional modules.
<br><br>


## QUICK START & DOCUMENTATION
1) Edit `lib/CORE-config.php`. Change `HOST_BASE` (A) and the database settings (B) to your own.
2) Create a dummy database for your project. If you don’t need the use of a database, open `lib/CORE-go.php` and remove `$_CORE->load("DB")`.
3) Access `index.php` in your browser, this will generate the necessary `.htaccess` and `api/.htaccess` files.
4) Open `index.php` and remove the marked section.
5) Done! You now have a working basic framework. Also consider using `html template` if you need a kickstart with the client-side. It is built on [Bootstrap](https://getbootstrap.com/) and [Material Icons](https://fonts.google.com/icons).

Visit [Code Boxx](https://code-boxx.com/core-boxx-php-rapid-development-framework/) for more for the full documentation!
<br><br>


## SCREENSHOTS (WITH HTML TEMPLATE)
<p float="left">
  <img width="350" style="inline-block" src="https://code-boxx.com/wp-content/uploads/2021/12/cb-html-1a.png">
  <img width="350" style="inline-block" src="https://code-boxx.com/wp-content/uploads/2021/12/cb-html-2a.png">
</p><br>


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

