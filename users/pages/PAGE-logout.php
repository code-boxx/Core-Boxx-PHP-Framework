<?php
// OR YOU CAN JUST CALL THE SESSION API
$_CORE->load("Users");
$_CORE->Users->logout();
$_CORE->redirect();
