<?php
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Expose-Headers: Content-Length, X-JSON");
     header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
     header("Access-Control-Allow-Headers: *");
     class Config{
          private $host_name  = "localhost";                  // server name
          private $database   = "reservation_system";        // Change your database name
          private $username   = "root";                     // Your database user id 
          private $password   = "";                        // Your password

          protected function connect(){
               try {

                    return new PDO('mysql:host='.$this->host_name.';dbname='.$this->database.';', $this->username, $this->password);
               } catch (PDOException $e) {
                    print "Error!: " . $e->getMessage() . "<br/>";
                    die();
               }
          }
     }