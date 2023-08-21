## CORE BOXX LOGIN WITH GOOGLE MODULE
https://code-boxx.com/core-boxx-google-login-module/

## REQUIREMENTS
* [Core Boxx](https://github.com/code-boxx/Core-Boxx/tree/main/core)
* [Users Module](https://github.com/code-boxx/Core-Boxx/tree/main/users)

## REGISTER WITH GOOGLE
* Head over to [Google API Console](https://console.cloud.google.com/apis/dashboard)
* Create a new project, or select an existing project.
* Next, go under "OAuth consent screen".
  - Fill in your app info.
  - Scopes can be left blank.
  - Under "Test Users", add your own Gmail account.
  - Leave the app as "testing", do not publish until you are ready.
* Finally, go under "Credentials".
  - Create credentials > OAuth client ID.
  - Set the name of your app, set your origin - `http://your-site.com`.
  - Set redirect URL as `http://your-site.com/login`.
  - On complete, Google will give you the client ID and secret. Download and save it as `lib/CRD-Google.json`.

## INSTALL
* Copy/unzip this module into your existing Core Boxx project folder.
* Run `install-GOOIN.php`, this will automatically:
  - Add Google login button to `pages/PAGE-login.php`.
  - Add Google sign up button to `pages/PAGE-register.php`.
  - Delete `install-GOOIN.php` itself.

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
