<?php
spl_autoload_register(function( $className ){

     if (file_exists('Controller/' .$className. '.php') || file_exists('Controller/' .$className. '.php')){
          
          $dir = 'Controller/';
          if(file_exists('Controller/' .$className. '.php')) $dir = 'Controller/';
          require_once $dir . $className. '.php';
  
      }else if( file_exists('Model/' .$className. '.php') || file_exists('Model/' .$className. '.php') ){

          $dir = 'Model/';
          if(file_exists('Model/' .$className. '.php')) $dir = 'Model/';
          require_once $dir . $className. '.php';

      }else if( file_exists('Config/' .$className. '.php') || file_exists('Config/' .$className. '.php') ){

          $dir = 'Config/';
          if(file_exists('Config/' .$className. '.php')) $dir = 'Config/';
          require_once $dir . $className. '.php';

      }
 
 });
 