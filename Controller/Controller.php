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
    public function activateFacility(){
        $deactivate = $this->dynamicSLCTLabeledQuery("UPDATE facility set status = :status WHERE Facility_id =:facilityId", array(
            ':facilityId' => $_POST['facilityId'],
            ':status' => 'Activate'
        ));

        return [
            'status'    =>  'success'
        ];
    }
    public function deletetFacility() {

        $checkResQuery = "SELECT * FROM reservation_facility WHERE facilityId = :facilityId";
        $param = array(
            ':facilityId' => $_POST['facilityId']
        );

        $resRes = $this->dynamicSLCTLabeledQuery($checkResQuery, $param);
        $data = $resRes['data']->fetchAll(PDO::FETCH_ASSOC);
        
        if($data){
            $deactivate = $this->dynamicSLCTLabeledQuery("UPDATE facility set status = :status WHERE Facility_id =:facilityId", array(
                ':facilityId' => $_POST['facilityId'],
                ':status' => 'Deactivate'
            ));

            return [
                'status'    =>  'error'
            ];
        }
        
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
                         Event,
                         Number_of_guest,
                         Reservation_status)
                    VALUES
                        (:Customer,
                         :Event,
                         :Guest ,
                         :Status)";

        $placeholders = array(
            ':Customer'      => $_POST['customer'],
            ':Event'         => $_POST['event'],
            ':Guest'         =>  $_POST['guest'],
            ':Status'        =>  'Unpaid'
        );
        $dml = $this->dynamicDMLLabeledQuery($sql, $placeholders);

        $sqlFacilityRes = "INSERT INTO reservation_facility (reservationId, dateIn, dateOut, totalAmout, facilityId)VALUES(:reservationId, :dateIn, :dateOut, :totalAmout, :facilityId)";
        // numberOfDays
        // price
        $totalPayment = $_POST['numberOfDays'] * $_POST['price'];

        $placeholdersFacRes = array(
            ':reservationId'      => $dml['id'],
            ':dateIn'         => $_POST['eventfrom'],
            ':dateOut'         =>  $_POST['eventto'],
            ':totalAmout'        =>  $totalPayment,
            ':facilityId'       => $_POST['facility']
        );
        $dmlFaci = $this->dynamicDMLLabeledQuery($sqlFacilityRes, $placeholdersFacRes);

        return $dml;

    }
    public function getReservation(){

        $str = "SELECT 
                    * 
                FROM 
                    reservation 
                LEFT JOIN 
                    customer 
                ON 
                    reservation.Customer_id = customer.customer_id
                GROUP BY
                    reservation.Reservation_id
                ORDER BY
                    reservation.createdDate DESC";

        $reservations = $this->dynamicSLCTQuery($str);
        $reservationData = $reservations['data']->fetchAll(PDO::FETCH_ASSOC);
        // +++++++
    
        $list = [];

        foreach ($reservationData as $data) {

            $innerArr = array(
                'date' => date('d/M/Y', strtotime($data['createdDate'])),
                'customer' => $data['FirstName'] . ' ' . $data['LastName'],
                'numberOfCustomer' => $data['Number_of_guest'],
                'status' => $data['Reservation_status'],
                'reservationId' => $data['Reservation_id'],
                'customerId' => $data['customer_id']
            );





            // array_push($list, );
            $str = "SELECT 
                            * 
                        FROM 
                            reservation_facility 
                        LEFT JOIN 
                            facility
                        ON 
                            reservation_facility.facilityId = facility.Facility_id
                        WHERE 
                            reservation_facility.reservationId = :reservationId
                        GROUP BY
                            reservation_facility.reservationFacilityId";

            $param = array(
                ':reservationId' => $data['Reservation_id']
            );




            $facilities = $this->dynamicSLCTLabeledQuery($str, $param);
            $facilitiesData = $facilities['data']->fetchAll(PDO::FETCH_ASSOC);
            $facilitiesArr = [];
            $totalAmountFac = 0;
            foreach ($facilitiesData as $facility) {
                $totalAmountFac += $facility['totalAmout'];
                array_push($facilitiesArr, 
                    array(
                        'faclityName' => $facility['Facility_name'],
                        'facilityDate' => date('d/M/Y', strtotime($facility['dateIn'])) . ' - ' . date('d/M/Y', strtotime($facility['dateOut'])),
                        'facilityId' => $facility['facilityId']
                    )
                );
            }
            $innerArr['totalAmountFac'] = $totalAmountFac;
            $innerArr['facilities'] = $facilitiesArr;
            array_push($list, $innerArr);
        }

        // echo "<pre>";
        // print_r($list);
        // die;
        return $list;
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
        
        if(isset($_SESSION['reservationIdTemp'])){
            if($custRes){
                $updateResrv = "UPDATE reservation set Customer_id =:customerId WHERE Reservation_id =:resrvId";
                $param = array(
                    ':resrvId' => $_SESSION['reservationIdTemp'],
                    ':customerId' => $custRes['customer_id']
                );
                $reservationIdTemp = $_SESSION['reservationIdTemp'];
                $customerId = $custRes['customer_id'];
                // echo $_SESSION['reservationIdTemp'];
                if(isset($_SESSION['reservationIdTemp'])) unset($_SESSION['reservationIdTemp']);
                $updateRes = $this->dynamicSLCTLabeledQuery($updateResrv, $param);
                $custRes['reservationIdTemp'] = $reservationIdTemp;
                $custRes['customerId'] = $customerId;
            }
        }

        return $custRes;
    }
    public function insertPayment(){

        $valid_extensions = array('jpeg', 'jpg', 'png'); // valid 
        $path = getcwd() . '/public/uploads/images/'; // upload directory
        $date = date("Y-m-d");
        $sql = "INSERT 
                    INTO 
                        payments(Customer_id,Facility_id,Reservation_id,Payment_date,Amount,Status,Receipt)
                    VALUES
                        (:Customer_id,:Facility_id,:Reservation_id,:Payment_date,:Amount,:Status,:Image)";


        $placeholders = array(
            ':Customer_id'      => $_POST['customer'],
            ':Facility_id'      => $_POST['facility'],
            ':Reservation_id'   => $_POST['reservation'],
            ':Payment_date'     => $date,
            ':Amount'           => $_POST['amount'],
            ':Status'           => 'Success'
        );
        $reservationplaceholders = array(
            ':Reserve_Id'    => $_POST['reservation'],
            ':Status'        => 'Reserved'
        );
        $reservationsql = "UPDATE reservation SET Reservation_status =:Status WHERE Reservation_id = :Reserve_Id";

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

                    $placeholders[':Image'] = $final_image;
                    $dml = $this->dynamicDMLLabeledQuery($sql, $placeholders);
                    $dml = $this->dynamicDMLLabeledQuery($reservationsql, $reservationplaceholders);
                    return array(
                        'status' => 'success',
                        'message' => 'Payment Success!'
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

        } else {

            $placeholders[':Image'] = '';
            $dml = $this->dynamicDMLLabeledQuery($sql, $placeholders);
            $dml = $this->dynamicDMLLabeledQuery($reservationsql, $reservationplaceholders);
            return array(
                'status' => 'success',
                'message' => 'Payment Success!'
            );

        }

        // return $dml;
        // print_r($dml['data']->fetchALL( PDO::FETCH_ASSOC ));
        
    }

    public function getPayment(){
        $payments = $this->dynamicSLCTQuery("SELECT * FROM payments LEFT JOIN facility ON facility.Facility_id = payments.Facility_id LEFT JOIN customer ON customer.customer_id = payments.Customer_id LEFT JOIN reservation ON reservation.Reservation_id = payments.Reservation_id GROUP BY payments.Payment_id ORDER BY payments.Payment_id ASC");
        return $payments['data']->fetchAll(PDO::FETCH_ASSOC);
    }

    public function customerReg(){
        // TODO::
        // Add the customer, add The reservation, after reservation, let the user register, if not registered or redirect to the reservation details if registered,
        $qryCustomer = 'INSERT INTO customer(FirstName, MiddleName, LastName, PhoneNumber, Address, Email, Age, Gender, Password, username)VALUES(:FirstName, :MiddleName, :LastName, :PhoneNumber, :Address, :Email, :Age, :Gender, :Password, :username)';
        
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $middlename = $_POST['middlename'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $address = $_POST['address'];

        $placeholderCustomer = array(
            ':FirstName' => $firstname,
            ':MiddleName' => $middlename, 
            ':LastName' => $lastname, 
            ':PhoneNumber' => $phone, 
            ':Address' => $address, 
            ':Email' => $email, 
            ':Age' => $age,
            ':Gender' => $gender,
            ':Password' => $password,
            ':username' => $username
        );

        
        $rtrnCustomer = $this->dynamicDMLLabeledQuery($qryCustomer, $placeholderCustomer);
        if($rtrnCustomer['status'] == 'success'){

            $_SESSION['user_data'] = array(
                                            'FirstName' => $_POST['firstname'],
                                            'MiddleName' => $_POST['middlename'],
                                            'LastName' => $_POST['lastname'],
                                            'customer_id' => $rtrnCustomer['id'],
                                            'resrvId' => $_SESSION['reservationIdTemp']
                                        );

            if(isset($_SESSION['reservationIdTemp'])){
                $updateResrv = "UPDATE reservation set Customer_id =:customerId WHERE Reservation_id =:resrvId";
                $param = array(
                    ':resrvId' => $_SESSION['reservationIdTemp'],
                    ':customerId' => $rtrnCustomer['id']
                );
                if(isset($_SESSION['reservationIdTemp'])) unset($_SESSION['reservationIdTemp']);
                $updateRes = $this->dynamicSLCTLabeledQuery($updateResrv, $param);
            }

            return $rtrnCustomer;
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
                WHERE 
                    reservation.Customer_id = :customerId
                GROUP BY
                    reservation.Reservation_id
                ORDER BY
                    reservation.createdDate
                DESC";

        $param = array(
            ':customerId' => $customerID
        );
        $reservations = $this->dynamicSLCTLabeledQuery($str, $param);


        $reservationData = $reservations['data']->fetchAll(PDO::FETCH_ASSOC);
        $list = [];

        foreach ($reservationData as $data) {

            $innerArr = array(
                'date' => date('d/M/Y', strtotime($data['createdDate'])),
                'customer' => $data['FirstName'] . ' ' . $data['LastName'],
                'numberOfCustomer' => $data['Number_of_guest'],
                'status' => $data['Reservation_status'],
                'reservationId' => $data['Reservation_id'],
                'customerID' => $customerID
            );
            // array_push($list, );
            $str = "SELECT 
                            * 
                        FROM 
                            reservation_facility 
                        LEFT JOIN 
                            facility
                        ON 
                            reservation_facility.facilityId = facility.Facility_id
                        WHERE 
                            reservation_facility.reservationId = :reservationId
                        GROUP BY
                            reservation_facility.reservationFacilityId";

            $param = array(
                ':reservationId' => $data['Reservation_id']
            );
            $facilities = $this->dynamicSLCTLabeledQuery($str, $param);
            $facilitiesData = $facilities['data']->fetchAll(PDO::FETCH_ASSOC);
            $facilitiesArr = [];
            $totalAmountFac = 0;
            foreach ($facilitiesData as $facility) {
                $totalAmountFac += $facility['totalAmout'];
                array_push($facilitiesArr, 
                    array(
                        'faclityName' => $facility['Facility_name'],
                        'facilityDate' => date('d/M/Y', strtotime($facility['dateIn'])) . ' - ' . date('d/M/Y', strtotime($facility['dateOut'])),
                        'facilityId' => $facility['facilityId']
                    )
                );
            }
            $innerArr['totalAmountFac'] = $totalAmountFac;
            $innerArr['facilities'] = $facilitiesArr;
            array_push($list, $innerArr);
        }
        return $list;
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

    public function getTheFicilities(){
        $str = "SELECT * FROM facility";
        $facilities = $this->dynamicSLCTQuery($str);
        $dataRet = $facilities['data']->fetchAll(PDO::FETCH_ASSOC);
        return $dataRet;
    }

    public function getFacilityReservation(){
        $query = "SELECT * FROM reservation_facility LEFT JOIN reservation ON reservation_facility.reservationId=reservation.Reservation_id WHERE facilityId = :facilityId AND (reservation.Reservation_status = 'Reserved' OR reservation.Reservation_status = 'Partially paid')";
        $dataReserved = [];
        $param = array(
            ':facilityId' => $_POST['faciltyId']
        );
        $reservedFacilities = $this->dynamicSLCTLabeledQuery($query, $param);
        $reservedFacilitiesData = $reservedFacilities['data']->fetchAll(PDO::FETCH_ASSOC);
        foreach ($reservedFacilitiesData as $reservedFacility) {

            $dateIn = strtotime($reservedFacility['dateIn']);
            $dateOut = strtotime($reservedFacility['dateOut']);
            $dateDiff = $dateOut - $dateIn;
            
            $daysDiff = round($dateDiff / (60 * 60 * 24));
            array_push($dataReserved, $reservedFacility['dateIn']);
            for ($i=1; $i <= $daysDiff; $i++) {
                $dateStr = $reservedFacility['dateIn'];
                $tobePushed = date('Y-m-d', strtotime($dateStr . '+ ' . $i . ' days'));
                array_push($dataReserved, $tobePushed);
            }
        }
        return $dataReserved;
    }
    public function submitReservation(){
        
        $insertReservationQry = "INSERT INTO reservation (Number_of_guest, Reservation_status, Event, Customer_id)VALUES(:Number_of_guest, :Reservation_status, :Event, :CustomerId)";
        $customerId = (!isset($_SESSION['user_data']['customer_id'])) ? '' : $_SESSION['user_data']['customer_id'];
        $placeholderReservation = array(
            ':Number_of_guest' => 0,
            // ':numberOfAdults' => 0, 
            // ':numberOfChildren' => 0,
            ':Reservation_status' => 'Unpaid',
            ':Event' => $_POST['event'],
            ':CustomerId' => $customerId
        );
        $rtrnReservation = $this->dynamicDMLLabeledQuery($insertReservationQry, $placeholderReservation);
        if($rtrnReservation['status'] == 'success'){
            
            foreach ($_SESSION['Facilities'] as $facility) {
                $insertReservationFacility = "INSERT INTO reservation_facility(facilityId, reservationId, dateIn, dateOut, totalAmout) VALUES (:facilityId, :reservationId, :dateIn, :dateOut, :totalAmout)";
                $placeholderReservationFacility = array(
                    ':facilityId' => $facility['facilityId'],
                    ':reservationId' => $rtrnReservation['id'],
                    ':dateIn' => $facility['dateFrom'],
                    ':dateOut' => $facility['dateTo'],
                    ':totalAmout' => $facility['totalAmount']
                );
                $rtrnReservationFacility = $this->dynamicDMLLabeledQuery($insertReservationFacility, $placeholderReservationFacility);
            }

            if(!isset($_SESSION['user_data']['customer_id'])){
                unset($_SESSION['Facilities']);
                $_SESSION['reservationIdTemp'] = $rtrnReservation['id'];
                header('Location:front-end/login.php');
            }else{
                unset($_SESSION['Facilities']);
                header('Location:front-end/makePayment.php?reservationId=' . $rtrnReservation['id'] . '&customerId=' . $customerId . '');
            }
        
        }

    }

    public function getSpecificReservation($reservationId){
        // TODO:: calculate the payment based on days

        $str = "SELECT 
                        * 
                    FROM 
                        reservation_facility 
                    LEFT JOIN 
                        facility
                    ON 
                        reservation_facility.facilityId = facility.Facility_id
                    WHERE
                        reservation_facility.reservationId = :reservationId
                    GROUP BY
                        reservation_facility.reservationFacilityId";
        $param = array(
            ':reservationId' => $_GET['reservationId']
        );

        $facilities = $this->dynamicSLCTLabeledQuery($str, $param);
        $facilitiesData = $facilities['data']->fetchAll(PDO::FETCH_ASSOC);
        return $facilitiesData;
    }
    public function makePaymentManual(){


        $insertBilling = "INSERT INTO billing(PaymentMode, CustomerId, ReservationId, TotalBill)VALUES(:PaymentMode, :CustomerId, :ReservationId, :TotalBill)";
        $insertBillingParam = array(
            ':PaymentMode' => 'Manual',
            ':CustomerId' => $_POST['cusId'],
            ':ReservationId' => $_POST['resId'],
            ':TotalBill' => $_POST['payment-amount']
        );

        $rtrnInsertBilling = $this->dynamicDMLLabeledQuery($insertBilling, $insertBillingParam);
        $isPartial = (isset($_POST['isPartial']) && $_POST['isPartial'] == true) ? true : false;
        $paymentInsert = "INSERT INTO payments(Gcash_number, Customer_id, Reservation_id, isPartial, Status, Amount, type) VALUES (:Gcash_number, :Customer_id, :Reservation_id, :isPartial, :status, :Amount, :type)";
        $paymentInsertParam = array(
            ':Gcash_number' => $_POST['gcash-numner'],
            ':Customer_id' => $_POST['cusId'],
            ':Reservation_id' => $_POST['resId'],
            ':isPartial' => $isPartial,
            ':status'   => 'Success',
            ':Amount' => $_POST['payment-amount'],
            ':type' => 'Manual'
        );

        $rtrnInsertPayment = $this->dynamicDMLLabeledQuery($paymentInsert, $paymentInsertParam);
        $reservationStatus = 'Reserved';
        if($isPartial){
            $reservationStatus = 'Partially paid';
        }

        $updateReservation = "UPDATE reservation set Reservation_status = :reservationStatus WHERE Reservation_id = :reservationId";
        $updateReservationParam = array(
            ':reservationStatus' => $reservationStatus,
            ':reservationId' => $_POST['resId']
        );
        $rtrnupdateReservation = $this->dynamicDMLLabeledQuery($updateReservation, $updateReservationParam);
        return $rtrnupdateReservation;

    }
    public function makePayment(){
        // echo $_POST['resId'];
        // check kung naa bai naka reserved
        // reserved

        // foreach (unserialize($_POST['scheduled']) as $date) {
        //     # code...
        //     echo $date;

        // }
        // $getRerserved = "SELECT * FROM reservation_facility LEFT JOIN reservation ON reservation_facility.reservationId = reservation.Reservation_id WHERE reservation_facility.reservationId =:resId AND ";
        // $getRerservedParam = array(
        //     ':resId' => $_POST['resId']
        // );

        // $rtrnIgetRerserved = $this->dynamicSLCTLabeledQuery($getRerserved, $getRerservedParam);
        // $rtrnIgetRerservedData = $rtrnIgetRerserved['data']->fetchAll(PDO::FETCH_ASSOC);




        $srcStr = 'public/uploads/images/';
        $fileName = $_POST['resId'] . basename($_FILES["payment-receipt"]["name"]);
        $target_file = $srcStr . $fileName;
        $uploadReceipt = move_uploaded_file($_FILES["payment-receipt"]["tmp_name"], $target_file);

        if($uploadReceipt){

            $insertBilling = "INSERT INTO billing(PaymentMode, CustomerId, ReservationId, TotalBill)VALUES(:PaymentMode, :CustomerId, :ReservationId, :TotalBill)";
            $insertBillingParam = array(
                ':PaymentMode' => 'Gcash',
                ':CustomerId' => $_POST['cusId'],
                ':ReservationId' => $_POST['resId'],
                ':TotalBill' => $_POST['payment-amount']
            );

            $rtrnInsertBilling = $this->dynamicDMLLabeledQuery($insertBilling, $insertBillingParam);
            $isPartial = (isset($_POST['isPartial']) && $_POST['isPartial'] == true) ? true : false;
            $paymentInsert = "INSERT INTO payments(Gcash_number, Customer_id, Reservation_id, Receipt, isPartial, Status, Amount, type) VALUES (:Gcash_number, :Customer_id, :Reservation_id, :fileName, :isPartial, :status, :Amount, :type)";
            $paymentInsertParam = array(
                ':Gcash_number' => $_POST['gcash-numner'],
                ':Customer_id' => $_POST['cusId'],
                ':Reservation_id' => $_POST['resId'],
                ':fileName' => $fileName,
                ':isPartial' => $isPartial,
                ':status'   => 'Success',
                ':Amount' => $_POST['payment-amount'],
                ':type' => 'Electronic Pay'
            );

            $rtrnInsertPayment = $this->dynamicDMLLabeledQuery($paymentInsert, $paymentInsertParam);
            $reservationStatus = 'Reserved';
            if($isPartial){
                $reservationStatus = 'Partially paid';
            }

            $updateReservation = "UPDATE reservation set Reservation_status = :reservationStatus WHERE Reservation_id = :reservationId";
            $updateReservationParam = array(
                ':reservationStatus' => $reservationStatus,
                ':reservationId' => $_POST['resId']
            );
            $rtrnupdateReservation = $this->dynamicDMLLabeledQuery($updateReservation, $updateReservationParam);
            return $rtrnupdateReservation;

        }

    }

    public function getTheResInDate(){

        // print_r(unserialize($_POST['facilityIds']));
        // die();

        $getRerserved = "SELECT 
                                * 
                            FROM 
                                reservation_facility 
                            LEFT JOIN 
                                reservation 
                            ON 
                                reservation_facility.reservationId = reservation.Reservation_id 
                            WHERE 
                                reservation_facility.reservationId =:resId";

        $getRerservedParam = array(
            ':resId' => $_POST['resId']
        );


        $rtrnIgetRerserved = $this->dynamicSLCTLabeledQuery($getRerserved, $getRerservedParam);
        $rtrnIgetRerservedData = $rtrnIgetRerserved['data']->fetchAll(PDO::FETCH_ASSOC);
        $reservFac = array();
        foreach ($rtrnIgetRerservedData as $data) {

            $dateIn = strtotime($data['dateIn']);
            $dateOut = strtotime($data['dateOut']);
            $dateDiff = $dateOut - $dateIn;
            
            $daysDiff = round($dateDiff / (60 * 60 * 24));

            $reservFacInner = [];
            $daysDiff = round($dateDiff / (60 * 60 * 24));
            array_push($reservFacInner, $data['dateIn']);
            for ($i=1; $i <= $daysDiff; $i++) {
                $dateStr = $data['dateIn'];
                $tobePushed = date('Y-m-d', strtotime($dateStr . '+ ' . $i . ' days'));
                array_push($reservFacInner, $tobePushed);
            }

            $reservFac[$data['facilityId']] = $reservFacInner;
            
            // if(array_key_exists($data['facilityId'], $reservFac)){
            //     $reservFac[$data['facilityId']] = $reservFacInner;
            // }else{
            //     $reservFac[$data['facilityId']] = $reservFacInner;
            // }

        }
        return $reservFac;

    }

    public function getThePayments(){

        $sql = 'SELECT * FROM payments WHERE Reservation_id = :reservationId';
        $getPaymentsParam = array(
            ':reservationId' => $_GET['reservationId']
        );
        $getThePayments = $this->dynamicSLCTLabeledQuery($sql, $getPaymentsParam);
        return $getThePayments['data']->fetchAll(PDO::FETCH_ASSOC);

    }
    public function cancelReservation(){

        $reservationId = $_POST['reservationId'];
        $sql = "UPDATE reservation set Reservation_status =:ReservationStatus WHERE Reservation_id =:reservationId";
        $updateResParam = array(
            ':reservationId' => $reservationId,
            ':ReservationStatus' => 'Pending Cancel'
        );
        $rtrnupdateReservation = $this->dynamicDMLLabeledQuery($sql, $updateResParam);
        return $rtrnupdateReservation;
    }
    public function getSpecificPays($resId){
        $sql = 'SELECT * FROM payments WHERE Reservation_id = :reservationId';
        $getPaymentsParam = array(
            ':reservationId' => $resId
        );
        $getThePayments = $this->dynamicSLCTLabeledQuery($sql, $getPaymentsParam);
        return $getThePayments['data']->fetchAll(PDO::FETCH_ASSOC);
    }

    public function makeRefund(){

        // Update the Billing
        // Update Reservation
        // INSERT Payment
        $fileName = '';
        $paymentType = 'Manual';
        $PaymentMode = '';
        if(!isset($_POST['isManualPayment'])){
            $srcStr = 'public/uploads/images/';
            $fileName = $_POST['resId'] . basename($_FILES["reciept"]["name"]);
            $target_file = $srcStr . $fileName;
            $uploadReceipt = move_uploaded_file($_FILES["reciept"]["tmp_name"], $target_file);
            $paymentType = 'Electronic Pay';
            $PaymentMode = 'Gcash';
        }

        $insertPaymentSQL = "INSERT INTO payments(Customer_id, Gcash_number, Reservation_id, Status, Amount, Receipt, type, isRefund)VALUES(:Customer_id, :Gcash_number, :Reservation_id, :Status, :Amount, :Receipt, :type, :isRefund)";
        $paymentSQLParam = array(
            ':Customer_id' => $_POST['cusId'], 
            ':Gcash_number' => $_POST['gcashNumber'], 
            ':Reservation_id' => $_POST['resId'], 
            ':Status' => 'Success',
            ':Amount' => $_POST['amount'], 
            ':Receipt' => $fileName, 
            ':type' => $paymentType, 
            ':isRefund' => true
        );

        $insertPayment = $this->dynamicDMLLabeledQuery($insertPaymentSQL, $paymentSQLParam);
        $totalBill = $_POST['amount'] * -1;
        $insertBillingSql = "INSERT into billing(PaymentMode, CustomerId, ReservationId, TotalBill, isRefund)VALUES(:PaymentMode, :CustomerId, :ReservationId, :TotalBill, :isRefund)";
        $insertBillingParam = array(
            ':PaymentMode' => $PaymentMode,
            ':CustomerId' => $_POST['cusId'],
            ':ReservationId' => $_POST['resId'],
            ':TotalBill' => $totalBill,
            ':isRefund' => true
        );
        
        $insertBilling = $this->dynamicDMLLabeledQuery($insertBillingSql, $insertBillingParam);

        $updateReservationSql = "UPDATE reservation set Reservation_status = :reservationStatus WHERE Reservation_id =:reservationId";
        $updateReservationParam = array(
            'reservationStatus' => 'Cencelled',
            'reservationId' => $_POST['resId']
        );
        $uodateReservation = $this->dynamicDMLLabeledQuery($updateReservationSql, $updateReservationParam);
    

    }
    public function updateSpecificRes($resId){

        $updateReservationSql = "UPDATE reservation set Reservation_status = :reservationStatus WHERE Reservation_id =:reservationId";
        $updateReservationParam = array(
            'reservationStatus' => 'Cencelled',
            'reservationId' => $resId
        );
        $uodateReservation = $this->dynamicDMLLabeledQuery($updateReservationSql, $updateReservationParam);
    
    }

    public function getEarnings($earningsPer){
        $getRerserved = "SELECT 
                                *
                            FROM 
                                billing
                            WHERE 
                                MONTH(createdDate) = MONTH(CURRENT_DATE())
                            AND 
                                YEAR(createdDate) = YEAR(CURRENT_DATE())";
        if($earningsPer == 'Annualy'){
            $getRerserved = "SELECT 
                                    *
                                FROM 
                                    billing
                                WHERE
                                    YEAR(createdDate) = YEAR(CURRENT_DATE())";
        }
        if($earningsPer == 'Weekly'){
            $getRerserved = "SELECT 
                                    *
                                FROM 
                                    billing
                                WHERE
                                    YEARWEEK(`createdDate`, 1) = YEARWEEK(CURDATE(), 1)";
        }

        $getRecs = $this->dynamicSLCTQuery($getRerserved);

        $data = $getRecs['data']->fetchAll(PDO::FETCH_ASSOC);
        return $data;
     }
     public function salesReports($value, $type){

        $sql = "SELECT * FROM billing";
        $getRecs;
        if( $type == 'Monthly' ){
            # Montly report
            $sql .= " WHERE MONTH(createdDate) = MONTH(CURRENT_DATE()) AND YEAR(createdDate) = YEAR(CURRENT_DATE()) ORDER BY createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Yearly') {
            # Yearly report
            $sql .= " WHERE YEAR(createdDate) = YEAR(CURRENT_DATE()) ORDER BY createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Weekly') {
            # Yearly report
            

            $sql .= " WHERE YEARWEEK(`createdDate`, 1) = YEARWEEK(CURDATE(), 1) ORDER BY createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }else{
            # custom date select
            # date1-date2
            $exploded = explode(",", $value);
            $dateFrom = $exploded[0];
            $dateTo = $exploded[1];
            $sql .= " WHERE createdDate >= :dateFrom AND createdDate <= :dateTo ORDER BY createdDate ASC";

            $getRecs = $this->dynamicSLCTLabeledQuery($sql, array(
                ':dateFrom' => $dateFrom,
                ':dateTo' => $dateTo
            ));
        }
        $data = $getRecs['data']->fetchAll(PDO::FETCH_ASSOC);
        return $data;
     }
}
