<?php
// lOAD CONFIG 
require_once 'config/config.php';
// Load libraries

// Auto LOad Core Libraries 
spl_autoload_register(function($className){
  require_once 'libraries/'. $className .'.php';
});