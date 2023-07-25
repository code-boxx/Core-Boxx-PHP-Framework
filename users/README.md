## CORE BOXX USER MODULE
https://code-boxx.com/core-boxx-users-module/

## REQUIREMENTS
* [Core Boxx](https://github.com/code-boxx/Core-Boxx/tree/main/core)

## INSTALL
Just copy/unzip this module into your existing Core Boxx project folder. Run `install-users.php`, this will automatically:

* Import `lib/SQL-Users.sql` into your database.
* Add a new `USR_LVL` definition into `lib/CORE-Config.php`.
* Update `lib/HOOK-SESS-Save.php` to save only the user ID into the JWT.
* Update `lib/HOOK-SESS-Load.php` to load the user from the database.
* Delete `install-users.php` itself.

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