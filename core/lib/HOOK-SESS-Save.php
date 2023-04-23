<?php
// CALLED BY $_CORE->SESSION->SAVE()
// USE THIS TO OVERRIDE DATA TO BE SAVED INTO THE JWT

// (A) EXAMPLE - REMOVE USER SETTINGS
// if (isset($data["settings"])) { unset($data["settings"]); }