## CORE BOXX LOGIN WITH QR MODULE
https://code-boxx.com/core-boxx-qr-login-module/

## REQUIREMENTS
* [Core Boxx](https://github.com/code-boxx/Core-Boxx-PHP-Framework/tree/main/core)
* [Users Module](https://github.com/code-boxx/Core-Boxx-PHP-Framework/tree/main/users)
* [Admin Module](https://github.com/code-boxx/Core-Boxx-PHP-Framework/tree/main/admin)

## INSTALL
* Copy this module into your existing Core Boxx project folder.
* Access `http://your-site.com/install/QRIN`, this will automatically:
  - Modify `pages/ADM-users.php`, load additional JS for QR.
  - Add "QR Login" button to `pages/ADM-users-list.php`.
  - Modify `pages/PAGE-login.php`, load additional JS and add "QR login" button.
  - Delete `PAGE-install-QRIN.php` itself.

## NOTES
* Access admin users, select a user, "QR login".
* Create a QR token for the user.
* That's all, give the token to the user - Just scan to login.

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