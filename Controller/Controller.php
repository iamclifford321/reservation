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
    public function insertFacility(){


        $valid_extensions = array('jpeg', 'jpg', 'png'); // valid 
        $path = getcwd() . '/public/uploads/images/'; // upload directory

        if(isset($_FILES['file']) && $_FILES['file']){
            $img = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];

            $final_image = rand(1000,1000000).$img;
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            if(in_array($ext, $valid_extensions)){
                // valid
                $path = $path . strtolower($final_image); 
                if(move_uploaded_file($tmp,$path)){
                    // Insert

                    $sql = "INSERT 
                                INTO 
                                    facility(Facility_name,Price,Image)
                                VALUES
                                    (:Facility_name,:Price,:Image)";


                    $placeholders = array(
                        ':Facility_name'    => $_POST['facility_name'],
                        ':Price'            => $_POST['price'],
                        ':Image'            => $final_image
                    );

                    $dml = $this->dynamicDMLLabeledQuery($sql, $placeholders);

                    return array(
                        'status' => 'success',
                        'message' => 'Successfully uploaded!'
                    );
                }else{
                    return array(
                        'status' => 'error',
                        'message' => 'Upload error'
                    );
                }
            }else{
                return array(
                    'status' => 'error',
                    'message' => 'Invalid file'
                );
            }

        }else{
                return array(
                    'status' => 'error',
                    'message' => 'No file'
                );
        }


        // return $dml;
        // print_r($dml['data']->fetchALL( PDO::FETCH_ASSOC ));
        
    }
    public function getFacility(){

        $facility = $this->dynamicSLCTQuery("SELECT * FROM facility ORDER BY Facility_id ASC");
        return $facility['data']->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSpecificFacility(){
        $facility = $this->dynamicSLCTLabeledQuery("SELECT * FROM facility WHERE Facility_id =:facilityId", array(
            ':facilityId' => $_POST['facilityId']
        ));
        return $facility['data']->fetch(PDO::FETCH_ASSOC);
    }

    public function updateFacility(){

        $valid_extensions = array('jpeg', 'jpg', 'png'); // valid 
        $path = getcwd() . '/public/uploads/images/'; // upload directory
        $placeholders = array(
                    ':Facility_name'    => $_POST['facility_name'],
                    ':Price'            => $_POST['price'],
                    ':facilityId'       => $_POST['facilityId']
                );
        $sql = "UPDATE facility SET Facility_name = :Facility_name,Price =:Price";

        if(isset($_FILES['file']) && $_FILES['file']){

            $img = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];

            $final_image = rand(1000,1000000).$img;
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            if(in_array($ext, $valid_extensions)){
                // valid
                $path = $path . strtolower($final_image); 
                if(move_uploaded_file($tmp,$path)){
                    // Insert
                    $sql .= ", Image =:Image";
                    $placeholders[':Image'] = $final_image;

                }else{
                    return array(
                        'status' => 'error',
                        'message' => 'Upload error'
                    );
                }
            }else{
                return array(
                    'status' => 'error',
                    'message' => 'Invalid file'
                );
            }
        }
        $sql .= ' Where Facility_id =:facilityId';
        $dml = $this->dynamicDMLLabeledQuery($sql, $placeholders);
        return array(
            'status' => 'success',
            'message' => 'Successfully uploaded!'
        );

    }
    public function deletetFacility() {

        $users = $this->dynamicSLCTLabeledQuery("DELETE FROM facility WHERE Facility_id =:facilityId", array(
            ':facilityId' => $_POST['facilityId']
        ));

        return [
                'status'    =>  'success'
        ];

    }
    public function insertReservation(){
        $sql = "INSERT 
                    INTO 
                        reservation 
                        (Customer_id,
                         Facility_id,
                         Event, 
                         Reservation_date, 
                         Date_in, 
                         Date_out,
                         Number_of_guest,
                         Reservation_status)
                    VALUES
                        (:Customer,
                         :Facility,
                         :Event,
                         :Eventdate,
                         :Eventfrom,
                         :Eventto,
                         :Guest ,
                         :Status)";

        $placeholders = array(
            ':Customer'      => $_POST['customer'],
            ':Facility'      => $_POST['facility'],
            ':Event'         => $_POST['event'],
            ':Eventdate'     =>  $_POST['eventfrom'],
            ':Eventfrom'     =>  $_POST['eventfrom'],
            ':Eventto'       =>  $_POST['eventto'],
            ':Guest'         =>  $_POST['guest'],
            ':Status'        =>  'Pending'
        );
        $dml = $this->dynamicDMLLabeledQuery($sql, $placeholders);
        return $dml;
        // print_r($dml['data']->fetchALL( PDO::FETCH_ASSOC ));
        
    }
    public function getReservation(){
        $reservation = $this->dynamicSLCTQuery("SELECT * FROM reservation LEFT JOIN facility ON facility.Facility_id = reservation.Facility_id LEFT JOIN customer ON customer.customer_id = reservation.Customer_id ORDER BY Reservation_id ASC");
        return $reservation['data']->fetchAll(PDO::FETCH_ASSOC);
    }
    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE Username = :username AND Password = :password";
        
        $users = $this->dynamicSLCTLabeledQuery($sql, array(
            ':username' => $username,
            ':password' => $password
        ));
        
        return $users['data']->fetch(PDO::FETCH_ASSOC);
    }
    public function loginCustomer(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM customer WHERE username = :username AND Password = :password";
        
        $customers = $this->dynamicSLCTLabeledQuery($sql, array(
            ':username' => $username,
            ':password' => $password
        ));
        $custRes = $customers['data']->fetch(PDO::FETCH_ASSOC);
        
        if(isset($_SESSION['reservationIdTemp']) || isset($_SESSION['customer_session_temp_info'])){
            if($custRes){
                $updateResrv = "UPDATE reservation set Customer_id =:customerId WHERE Reservation_id =:resrvId";
                $param = array(
                    ':resrvId' => $_SESSION['reservationIdTemp'],
                    ':customerId' => $custRes['customer_id']
                );
                // echo $_SESSION['reservationIdTemp'];
                if(isset($_SESSION['reservationIdTemp'])) unset($_SESSION['reservationIdTemp']);
                if(isset($_SESSION['customer_session_temp_info'])) unset($_SESSION['customer_session_temp_info']);
                $updateRes = $this->dynamicSLCTLabeledQuery($updateResrv, $param);
            }
        }

        return $custRes;
    }
    public function insertPayment(){


        $valid_extensions = array('jpeg', 'jpg', 'png'); // valid 
        $path = getcwd() . '/public/uploads/images/'; // upload directory

        if(isset($_FILES['file']) && $_FILES['file']){
            $img = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];
            $date = date("Y-m-d");

            $final_image = rand(1000,1000000).$img;
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            if(in_array($ext, $valid_extensions)){
                // valid
                $path = $path . strtolower($final_image); 
                if(move_uploaded_file($tmp,$path)){
                    // Insert

                    $sql = "INSERT 
                                INTO 
                                    payments(Customer_id,Facility_id,Receipt,Reservation_id,Payment_date,Amount,Status)
                                VALUES
                                    (:Customer_id,:Facility_id,:Image,:Reservation_id,:Payment_date,:Amount,:Status)";


                    $placeholders = array(
                        ':Customer_id'      => $_POST['customer'],
                        ':Facility_id'      => $_POST['facility'],
                        ':Image'            => $final_image,
                        ':Reservation_id'   => $_POST['reservation'],
                        ':Payment_date'     => $date,
                        ':Amount'           => $_POST['amount'],
                        ':Status'           => 'Pending'
                    );

                    $dml = $this->dynamicDMLLabeledQuery($sql, $placeholders);

                    return array(
                        'status' => 'success',
                        'message' => 'Successfully uploaded!'
                    );
                }else{
                    return array(
                        'status' => 'error',
                        'message' => 'Upload error'
                    );
                }
            }else{
                return array(
                    'status' => 'error',
                    'message' => 'Invalid file'
                );
            }

        }else{
                return array(
                    'status' => 'error',
                    'message' => 'No file'
                );
        }


        // return $dml;
        // print_r($dml['data']->fetchALL( PDO::FETCH_ASSOC ));
        
    }

    public function getPayment(){
        $payments = $this->dynamicSLCTQuery("SELECT * FROM payments LEFT JOIN facility ON facility.Facility_id = payments.Facility_id LEFT JOIN customer ON customer.customer_id = payments.Customer_id LEFT JOIN reservation ON reservation.Reservation_id = payments.Reservation_id ORDER BY Payment_id ASC");
        return $payments['data']->fetchAll(PDO::FETCH_ASSOC);
    }

    public function frontEndReserve(){
        // TODO::
        // Add the customer, add The reservation, after reservation, let the user register, if not registered or redirect to the reservation details if registered,
        $qryCustomer = 'INSERT INTO customer(FirstName, MiddleName, LastName, PhoneNumber, Address, Email, Age, Gender)VALUES(:FirstName, :MiddleName, :LastName, :PhoneNumber, :Address, :Email, :Age, :Gender)';
        
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $middlename = $_POST['middlename'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $facility = $_POST['facility'];
        $event = $_POST['event'];
        $guest = $_POST['guest'];



        $placeholderCustomer = array(
            ':FirstName' => $firstname,
            ':MiddleName' => $middlename, 
            ':LastName' => $lastname, 
            ':PhoneNumber' => $phone, 
            ':Address' => $address, 
            ':Email' => $email, 
            ':Age' => $age,
            ':Gender' => $gender
        );

        
        $rtrnCustomer = $this->dynamicDMLLabeledQuery($qryCustomer, $placeholderCustomer);
        if($rtrnCustomer['status'] == 'success'){
            $qryReservation = 'INSERT INTO reservation(Customer_id, Facility_id, Reservation_date, Date_in, Date_out, Number_of_guest, Reservation_status, Event)VALUES(:CustomerId, :FacilityId, :ReservationDate, :DateIn, :DateOut, :NumberOfGuest, :ReservationStatus, :Event)';
            $placeholderReservation = array(
                ':CustomerId' => $rtrnCustomer['id'],
                ':FacilityId' => $facility,
                ':ReservationDate' => str_replace("/", "-", $_POST['eventrom']),
                ':DateIn' => str_replace("/", "-", $_POST['eventrom']),
                ':DateOut' => str_replace("/", "-", $_POST['evento']),
                ':NumberOfGuest' => $guest,
                ':ReservationStatus' => 'Unpaid',
                ':Event' => $event
            );
            $rtrnReservation = $this->dynamicDMLLabeledQuery($qryReservation, $placeholderReservation);
            $data = array(
                'FirstName' => $firstname,
                'MiddleName' => $middlename, 
                'LastName' => $lastname, 
                'PhoneNumber' => $phone, 
                'Address' => $address, 
                'Email' => $email, 
                'Age' => $age,
                'Gender' => $gender,
                'customer_id' => $rtrnCustomer['id']
            );
            $_SESSION['customer_session_temp_info'] = $data;

            if($rtrnReservation['status']){
                $_SESSION['reservationIdTemp'] = $rtrnReservation['id'];
                return array(
                    'status' => 'success',
                    'message' => 'Reserved',
                    'Id' => $rtrnReservation['id']
                );
                
            }else{
                die('Something went wrong!');
            }
        }else{
            die('something went wrong!');
        }
    }
    public function updateFromCUstomer(){
        $sql = "UPDATE customer set Password =:password, username =:username WHERE customer_id =:cusId";
        $placeholders = array(
            ':username'     =>  $_POST['username'], 
            ':password'     =>  $_POST['password'],
            ':cusId'        =>  $_SESSION['customer_session_temp_info']['customer_id']
        );
        $_SESSION['user_data'] = $_SESSION['customer_session_temp_info'];
        unset( $_SESSION['customer_session_temp_info'] );
        $dml = $this->dynamicDMLLabeledQuery($sql, $placeholders);
        return $dml;
        
        // print_r($dml['data']->fetchALL( PDO::FETCH_ASSOC ));
        
    }
    public function getReservationSpecific($customerID){
        $str = "SELECT 
                    * 
                FROM 
                    reservation 
                LEFT JOIN 
                    customer 
                ON 
                    reservation.Customer_id = customer.customer_id 
                LEFT JOIN 
                    facility
                ON 
                    reservation.Facility_id = facility.Facility_id 
                WHERE 
                    reservation.Customer_id = :customerId";
        $param = array(
            ':customerId' => $customerID
        );
        $reservations = $this->dynamicSLCTLabeledQuery($str, $param);
        return $reservations['data']->fetchAll(PDO::FETCH_ASSOC);
    }
    public function submitBookLoggedIn(){

        $qryReservation = 'INSERT INTO reservation(Customer_id, Facility_id, Reservation_date, Date_in, Date_out, Number_of_guest, Reservation_status, Event)VALUES(:CustomerId, :FacilityId, :ReservationDate, :DateIn, :DateOut, :NumberOfGuest, :ReservationStatus, :Event)';
        $placeholderReservation = array(
            ':CustomerId' => $_POST['customer'],
            ':FacilityId' => $_POST['facility'],
            ':ReservationDate' => str_replace("/", "-", $_POST['eventrom']),
            ':DateIn' => str_replace("/", "-", $_POST['eventrom']),
            ':DateOut' => str_replace("/", "-", $_POST['evento']),
            ':NumberOfGuest' => $_POST['guest'],
            ':ReservationStatus' => 'Unpaid',
            ':Event' => $_POST['event']
        );

        $rtrnReservation = $this->dynamicDMLLabeledQuery($qryReservation, $placeholderReservation);
        return $rtrnReservation;
        // provide the needed logic
    }
}
