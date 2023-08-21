## CORE BOXX
Core Boxx is an open-source PHP framework built with the concept of simplicity and modularity. Install and load only what you need, not bloated with unused features.
<br><br>

## :white_check_mark: "OUT OF THE BOX" FEATURES
1) Pretty URL and routing.
2) API endpoints with CORS support.
3) Installable Progressive Web App.
4) JSON Web Token sessions.
5) Bootstrap HTML template.
<br><br>

## :joy: AS SIMPLE AS IT GETS
A typical development cycle with Core Boxx:
1) Create database table.
2) Create module library - `class MOD extends Core { function FN ... }`
3) Creat API endpoint - `$_CORE->autoAPI([ "ENDPOINT" => ["MOD", "FN" ]]);`
4) Create HTML pages and/or mobile app. The end.
<br><br>

## :camera: SCREENSHOTS
<p float="left">
  <img width="250" src="https://github.com/code-boxx/Core-Boxx/blob/main/core/assets/core-boxx-1.png">
  <img width="250" src="https://github.com/code-boxx/Core-Boxx/blob/main/core/assets/core-boxx-2.png">
  <img width="250" src="https://github.com/code-boxx/Core-Boxx/blob/main/core/assets/core-boxx-3.png">
  <img width="250" src="https://github.com/code-boxx/Core-Boxx/blob/main/core/assets/core-boxx-4.png">
  <img width="250" src="https://github.com/code-boxx/Core-Boxx/blob/main/core/assets/core-boxx-5.png">
  <img width="250" src="https://github.com/code-boxx/Core-Boxx/blob/main/core/assets/core-boxx-6.png">
</p>
<br><br>

## :ballot_box_with_check: REQUIREMENTS
1) LAMP/WAMP/MAMP/XAMPP
2) Apache Mod Rewrite
3) PHP MYSQL PDO Extension
4) At least PHP 8.0
<br><br>

## :floppy_disk: INSTALLATION & NOTES
1) Just copy `core/` into your project folder. Access `http://your-site.com/` in the browser and walk through the installer.
2) The rest are optional modules... Too lazy and messy to create separate repos for each.
3) Some modules may require "extra installation steps", do check out the respective documentation - https://code-boxx.com/core-boxx-php-framework/#sec-ref
<br><br>

## :bulb: DOCUMENTATION & FRAMEWORKS
1) Visit [Core Boxx](https://code-boxx.com/core-boxx-php-framework/) for more for the full documentation!
2) Built on [Bootstrap](https://getbootstrap.com/) and [IcoMoon](https://icomoon.io/).
3) Using [PHP-JWT library](https://github.com/firebase/php-jwt)
<br><br>

## :star: SUPPORT
Like this project? Just give it a star. That will indirectly help grow my blog a little bit. :wink:
<br><br>

## :newspaper: LICENSE
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