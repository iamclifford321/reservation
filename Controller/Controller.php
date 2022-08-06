<?php
class Controller extends Model{
    public function insertCustomer(){
        $sql = "INSERT 
                    INTO 
                        customer 
                        (FirstName,
                         MiddleName, 
                         LastName, 
                         PhoneNumber, 
                         Address, 
                         Email, 
                         Age, 
                         Gender)
                    VALUES
                        (:FirstName,
                         :MiddleName, 
                         :LastName, 
                         :PhoneNumber, 
                         :Address, 
                         :Email, 
                         :Age, 
                         :Gender)";

        $placeholders = array(
            ':FirstName'    => $_POST['firstname'],
            ':MiddleName'   => $_POST['middlename'],
            ':LastName'     => $_POST['lastname'],
            ':PhoneNumber'  => $_POST['phone'],
            ':Address'      => $_POST['address'],
            ':Email'        =>  $_POST['email'],
            ':Age'          =>  $_POST['age'],
            ':Gender'       => $_POST['gender']
        );
        $dml = $this->dynamicDMLLabeledQuery($sql, $placeholders);
        return $dml;
        // print_r($dml['data']->fetchALL( PDO::FETCH_ASSOC ));
        
    }
    public function getCustomer(){
        $customers = $this->dynamicSLCTQuery("SELECT * FROM customer ORDER BY createdDate ASC");
        return $customers['data']->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSpecificCustomer(){
        $customers = $this->dynamicSLCTLabeledQuery("SELECT * FROM customer WHERE customer_id =:customerId", array(
            ':customerId' => $_POST['customerId']
        ));
        return $customers['data']->fetch(PDO::FETCH_ASSOC);
    }
    public function updateCustomer(){
        $placeholders = array(
            ':FirstName' => $_POST['firstname'],
            ':MiddleName' => $_POST['middlename'],
            ':LastName' => $_POST['lastname'],
            ':PhoneNumber' => $_POST['phone'],
            ':Address' => $_POST['address'],
            ':Email' => $_POST['email'],
            ':Age' => $_POST['age'],
            ':Gender' => $_POST['gender'],
            ':customer_id' => $_POST['customerID']
        );
        $dml = $this->dynamicDMLLabeledQuery("UPDATE 
                                                    customer 
                                                SET 
                                                    FirstName=:FirstName, 
                                                    MiddleName=:MiddleName, 
                                                    LastName=:LastName,
                                                    PhoneNumber =:PhoneNumber,
                                                    Address=:Address,
                                                    Email=:Email,
                                                    Age=:Age,
                                                    Gender=:Gender
                                                WHERE
                                                    customer_id=:customer_id", $placeholders);
        return $dml;
    }

    // User function
    public function insertUser(){
        $sql = "INSERT 
                    INTO 
                        user 
                        (FirstName,
                         LastName, 
                         Address, 
                         Username, 
                         Password)
                    VALUES
                        (:FirstName,
                         :LastName,  
                         :Address, 
                         :Username, 
                         :Password)";

        $placeholders = array(
            ':FirstName'    => $_POST['firstname'],
            ':LastName'     => $_POST['lastname'],
            ':Address'      => $_POST['address'],
            ':Username'     =>  $_POST['username'],
            ':Password'     =>  $_POST['password']
        );
        $dml = $this->dynamicDMLLabeledQuery($sql, $placeholders);
        return $dml;
        // print_r($dml['data']->fetchALL( PDO::FETCH_ASSOC ));
        
    }

    public function getUser(){
        $users = $this->dynamicSLCTQuery("SELECT * FROM user ORDER BY User_id ASC");
        return $users['data']->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSpecificUser(){
        $users = $this->dynamicSLCTLabeledQuery("SELECT * FROM user WHERE User_id =:userId", array(
            ':userId' => $_POST['userId']
        ));
        return $users['data']->fetch(PDO::FETCH_ASSOC);
    }
    public function updateUser() {

        $placeholders = array(
            ':FirstName'    =>  $_POST['firstname'],
            ':LastName'     =>  $_POST['lastname'],
            ':Address'      =>  $_POST['address'],
            ':Username'     =>  $_POST['username'],
            ':user_id'      =>  $_POST['userId']
        );

        $sql = "UPDATE 
                    user 
                SET
                    FirstName=:FirstName,
                    LastName=:LastName, 
                    Address=:Address, 
                    Username=:Username
                WHERE
                    User_id=:user_id";
        $dml = $this->dynamicDMLLabeledQuery($sql, $placeholders);
        return $dml;
    }
    public function deletetUser() {

        $users = $this->dynamicSLCTLabeledQuery("DELETE FROM user WHERE User_id =:userId", array(
            ':userId' => $_POST['userId']
        ));

        return [
                'status'    =>  'success'
        ];

    }

    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE Username = :username AND Password = :password";
        
        $users = $this->dynamicSLCTLabeledQuery($sql, array(
            ':username' => $username,
            ':password' => $password
        ));

        return $users['data']->fetchAll(PDO::FETCH_ASSOC);
    }
} 