<?php 
/**
 * Base Controller
 * Load the Models and the Views
 * @autho youssef 
 * 
 */

class Controller{
  // load model 
  public function model($model){
    // require model file 
    require_once '../app/models/' . $model . '.php';
    // instantiate the model 
    return new $model();
  

  }
  // Load view 
  public function view($view, $data = []){
    // check for the view file 
    if(file_exists('../app/views/' . $view . '.php')){
      require_once '../app/views/' . $view . '.php';

    }else{
      die('The view does not exist');
    }

  }
}
