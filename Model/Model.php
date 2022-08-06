<?php
class Model extends Config{

     protected function dynamicDMLQuery( $query ){
          try {
               $pdo      = $this->connect();
               $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
               $stmt     = $pdo->prepare( $query );
               $stmt->execute();
               return [
                    'status'       => 'success',
                    'message'      => 'Inserted/Updated/Deleted',
                    'id'           => $pdo->lastInsertId(),
               ];
          } catch (PDOExecption $e) {
               die($e);
               //throw $th;
          }
     }

     protected function dynamicDMLLabeledQuery( $query, $placeHolders ){
          try {
               $pdo      = $this->connect();
               $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
               $stmt     = $pdo->prepare( $query );
               $stmt->execute($placeHolders);
               return [
                    'status'       => 'success',
                    'message'      => 'Inserted/Updated/Deleted',
                    'id'           => $pdo->lastInsertId(),
               ];
          } catch (PDOExecption $e) {
               die($e);
               //throw $th;
          }
     }

     protected function dynamicSLCTQuery( $query ){
          try {
               $pdo      = $this->connect();
               $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
               $stmt     = $pdo->prepare( $query );
               $res      = $stmt->execute();
               
               if($res){
                    return [
                         'status'       => 'success',
                         'message'      => 'data Retrived',
                         'data'         => $stmt
                    ];
               }else{
                    return [
                         'status'       => 'success',
                         'message'      => $this->Connect()->errorInfo(),
                         'data'         => null
                    ];
               }

          } catch (PDOExecption $e) {
               die($e);
               //throw $th;
          }
     }

     protected function dynamicSLCTLabeledQuery( $query, $placeHolders ){
          try {
               $pdo      = $this->connect();
               $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
               $stmt     = $pdo->prepare( $query );
               $res      = $stmt->execute($placeHolders);
               
               if($res){
                    return [
                         'status'       => 'success',
                         'message'      => 'data Retrived',
                         'data'         => $stmt
                    ];
               }else{
                    return [
                         'status'       => 'success',
                         'message'      => $this->Connect()->errorInfo(),
                         'data'         => null
                    ];
               }

          } catch (PDOExecption $e) {
               die($e);
               //throw $th;
          }
     }
}