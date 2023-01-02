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
            ':Age'          =>  null,
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
            ':Age' => null,
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
                                    facility(Facility_name,Price,Image, Category, description, status)
                                VALUES
                                    (:Facility_name,:Price,:Image, :Category, :description, :status)";


                    $placeholders = array(
                        ':Facility_name'    => $_POST['facility_name'],
                        ':Price'            => $_POST['price'],
                        ':Image'            => $final_image,
                        ':Category'         => $_POST['category'],
                        ':description'      => $_POST['Description'],
                        ':status'           => 'Activated'
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
                    ':facilityId'       => $_POST['facilityId'],
                    ':description'      => $_POST['Description']
                );
        $sql = "UPDATE facility SET Facility_name = :Facility_name,Price =:Price, description =:description";

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
            ':status' => 'Activated'
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
        // 

        $aminities = '';
        $totals = 0;
        if(isset($_POST['aminitiesJson'])){
            $aminities = serialize($_POST['aminitiesJson']);
            foreach ($_POST['aminitiesJson'] as $var) {
                $totals += $var['price'];
            }
        }

        $sql = "INSERT 
                    INTO 
                        reservation 
                        (Customer_id,
                         Event,
                         Number_of_guest,
                         Reservation_status,
                         aminities,
                         number_of_adults,
                         number_of_children,
                         paymentStatus)
                    VALUES
                        (:Customer,
                         :Event,
                         :Guest ,
                         :Status,
                         :aminities,
                         :number_of_adults,
                         :number_of_children,
                         :paymentStatus)";
        $tt = $_POST['numberOfAdults'] + $_POST['numberOfChildrens'];
        $placeholders = array(
            ':Customer'      => $_POST['customer'],
            ':Event'         => $_POST['event'],
            ':Guest'         =>  $tt,
            ':Status'        =>  'Pending',
            ':aminities'     => $aminities,
            ':number_of_adults' => $_POST['numberOfAdults'],
            ':number_of_children' => $_POST['numberOfChildrens'],
            ':paymentStatus' => 'Unpaid'
        );
        $dml = $this->dynamicDMLLabeledQuery($sql, $placeholders);

        $sqlFacilityRes = "INSERT INTO reservation_facility (reservationId, dateIn, dateOut, totalAmout, facilityId)VALUES(:reservationId, :dateIn, :dateOut, :totalAmout, :facilityId)";
        // numberOfDays
        // price
        $totalPayment = $_POST['numberOfDays'] * $_POST['price'];
        $totalPayment += $totals;
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
        $reservations;
        $str = "SELECT 
                    * 
                FROM 
                    reservation 
                LEFT JOIN 
                    customer 
                ON 
                    reservation.Customer_id = customer.customer_id ";

        if(isset($_POST['filterBy']) && $_POST['filterBy'] != null){
            $str .= " WHERE Reservation_status =:status ";
            $str .= "GROUP BY
                        reservation.Reservation_id
                    ORDER BY
                        reservation.Reservation_id ASC";
            $reservations = $this->dynamicSLCTLabeledQuery($str, array(
                ':status' => $_POST['filterBy']
            ));
        }else{
            
            $str .= "GROUP BY
                        reservation.Reservation_id
                    ORDER BY
                        reservation.Reservation_id ASC";
            $reservations = $this->dynamicSLCTQuery($str);
        }

        $reservationData = $reservations['data']->fetchAll(PDO::FETCH_ASSOC);
        // +++++++
    
        $list = [];

        foreach ($reservationData as $data) {

            $innerArr = array(
                'date' => date('M. d Y', strtotime($data['createdDate'])),
                'customer' => $data['FirstName'] . ' ' . $data['LastName'],
                'numberOfCustomer' => $data['Number_of_guest'],
                'status' => $data['Reservation_status'],
                'reservationId' => $data['Reservation_id'],
                'customerId' => $data['customer_id'],
                'paymentStatus' => $data['paymentStatus'],
                'phoneNum' => $data['PhoneNumber']
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
                        'facilityDate' => date('M. d Y', strtotime($facility['dateIn'])) . ' to ' . date('M. d Y', strtotime($facility['dateOut'])),
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
        $payments = $this->dynamicSLCTQuery("SELECT 
                                                    * 
                                                FROM 
                                                    payments
                                                LEFT JOIN 
                                                    customer 
                                                ON 
                                                    customer.customer_id = payments.Customer_id
                                                WHERE
                                                    payments.isIntrance = true
                                                GROUP BY 
                                                    payments.Payment_id 
                                                ORDER BY 
                                                    payments.Payment_id
                                                ASC");

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
                    reservation.Reservation_id
                DESC";

        $param = array(
            ':customerId' => $customerID
        );
        $reservations = $this->dynamicSLCTLabeledQuery($str, $param);


        $reservationData = $reservations['data']->fetchAll(PDO::FETCH_ASSOC);
        $list = [];

        foreach ($reservationData as $data) {

            $innerArr = array(
                'date' => date('M. d Y', strtotime($data['createdDate'])),
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
                        'facilityDate' => date('M. d Y', strtotime($facility['dateIn'])) . ' - ' . date('M. d Y', strtotime($facility['dateOut'])),
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
        $str = "SELECT * FROM reservation";
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

        $insertReservationQry = "INSERT INTO reservation (Number_of_guest, number_of_children, number_of_adults, Reservation_status, Event, Customer_id, aminities, paymentStatus)VALUES(:Number_of_guest, :number_of_children, :number_of_adults, :Reservation_status, :Event, :CustomerId, :aminities, :paymentStatus)";
        $customerId = (!isset($_SESSION['user_data']['customer_id'])) ? '' : $_SESSION['user_data']['customer_id'];
        $strjson = '';
        if(isset($_POST['aminities']) && $_POST['aminities'] != ''){
            $strjson = serialize(json_decode($_POST['aminities']));
        }
        $adultNumber = $_POST['adultNumber'];
        $childNumber = $_POST['childNumber'];
        $totalGuest = $adultNumber + $childNumber;
        $placeholderReservation = array(
            ':Number_of_guest' => $totalGuest,
            ':number_of_children' => $childNumber,
            ':number_of_adults' => $adultNumber,
            ':Reservation_status' => 'Pending',
            ':Event' => '',
            ':CustomerId' => $customerId,
            ':aminities' => $strjson,
            ':paymentStatus' => 'Unpaid'
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

        $balance = $_POST['balancePay'] - $_POST['payment-amount'];
        $isPartial = false;
        if($balance > 0){
            $isPartial = true;
        }
        // echo $balance;
        // // if($balance)
        // die();

        $insertBilling = "INSERT INTO billing(PaymentMode, CustomerId, ReservationId, TotalBill)VALUES(:PaymentMode, :CustomerId, :ReservationId, :TotalBill)";
        $insertBillingParam = array(
            ':PaymentMode' => 'Manual',
            ':CustomerId' => $_POST['cusId'],
            ':ReservationId' => $_POST['resId'],
            ':TotalBill' => $_POST['payment-amount']
        );

        $rtrnInsertBilling = $this->dynamicDMLLabeledQuery($insertBilling, $insertBillingParam);
        // $isPartial = (isset($_POST['isPartial']) && $_POST['isPartial'] == true) ? true : false;
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
        $paymentStatus = 'Partially paid';

        // $paymentStatus = 
        if(!$isPartial){
            $paymentStatus = 'Paid';
        }

        $updateReservation = "UPDATE reservation set paymentStatus = :paymentStatus WHERE Reservation_id = :reservationId";
        $updateReservationParam = array(
            ':paymentStatus' => $paymentStatus,
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


        $balance = $_POST['balance'] - $_POST['payment-amount'];
        
        $isPartial = false;
        
        if($balance > 0){
            echo 'test';
            $isPartial = true;
        }
        echo 'isPartial ' . $isPartial;
        echo 'balance ' .$balance;

        $paymentStatus = 'Partially paid';

        // $paymentStatus = 
        if(!$isPartial){
            $paymentStatus = 'Paid';
        }
        echo $paymentStatus;
        // die();
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

            $updateReservation = "UPDATE reservation set paymentStatus = :paymentStatus WHERE Reservation_id = :reservationId";
            
            $updateReservationParam = array(
                ':paymentStatus' => $paymentStatus,
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
            'reservationStatus' => 'Cancelled',
            'reservationId' => $_POST['resId']
        );
        $uodateReservation = $this->dynamicDMLLabeledQuery($updateReservationSql, $updateReservationParam);
    

    }
    public function updateSpecificRes($resId){
        // echo $resId
        // die();
        $updateReservationSql = "UPDATE reservation set Reservation_status = :reservationStatus WHERE Reservation_id =:reservationId";
        $updateReservationParam = array(
            'reservationStatus' => 'Cancelled',
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

        $sql = "SELECT 
                    * 
                FROM 
                    billing
                LEFT JOIN
                    customer
                on 
                    customer.customer_id = billing.CustomerId
                LEFT JOIN
                    reservation 
                on 
                    reservation.Reservation_id = billing.ReservationId
                LEFT JOIN 
                    reservation_facility
                on
                    reservation.Reservation_id = reservation_facility.reservationId
                LEFT JOIN
                    facility
                On 
                    facility.Facility_id = reservation_facility.facilityId";

        $getRecs;
        if( $type == 'Monthly' ){
            # Montly report
            $sql .= " WHERE MONTH(billing.createdDate) = MONTH(CURRENT_DATE()) AND YEAR(billing.createdDate) = YEAR(CURRENT_DATE()) ORDER BY billing.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Yearly') {
            # Yearly report
            $sql .= " WHERE YEAR(billing.createdDate) = YEAR(CURRENT_DATE()) ORDER BY billing.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Weekly') {
            # Yearly report
            

            $sql .= " WHERE YEARWEEK(billing.createdDate, 1) = YEARWEEK(CURDATE(), 1) ORDER BY billing.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }else{
            # custom date select
            # date1-date2
            $exploded = explode(",", $value);
            $dateFrom = $exploded[0];
            $dateTo = $exploded[1];
            $sql .= " WHERE billing.createdDate >= :dateFrom AND billing.createdDate <= :dateTo ORDER BY billing.createdDate ASC";

            $getRecs = $this->dynamicSLCTLabeledQuery($sql, array(
                ':dateFrom' => $dateFrom,
                ':dateTo' => $dateTo
            ));
        }
        $data = $getRecs['data']->fetchAll(PDO::FETCH_ASSOC);
        $listData = array();
        // echo '<pre>';
        foreach ($data as $value) {
            // echo 'res';
            if(array_key_exists($value['InvoiceNo'], $listData)){
                array_push($listData[$value['InvoiceNo']]['facilities'], array(
                    'facilityName' => $value['Facility_name'],
                    'facilityPrice' => $value['Price'],
                    'Category' => $value['Category'],
                    'dateFrom' => $value['dateIn'],
                    'dateTo' => $value['dateOut']
                ));
            }else{
                $listData[$value['InvoiceNo']] = array(
                    'date' => $value['PaymentDate'],
                    'isRefund' => ($value['isRefund']) ? 'Yes' : 'No',
                    'PaymentMode' => $value['PaymentMode'],
                    'reservationId' => $value['ReservationId'],
                    'amount' => $value['TotalBill'],
                    'customer' => ucFirst($value['FirstName']) . ' ' . ucFirst($value['MiddleName']) . ucFirst($value['LastName']),
                    'customerId' => $value['CustomerId'],
                    'facilities' => array(
                        array(
                            'facilityName' => $value['Facility_name'],
                            'facilityPrice' => $value['Price'],
                            'Category' => $value['Category'],
                            'dateFrom' => $value['dateIn'],
                            'dateTo' => $value['dateOut']
                        )
                    )
                );

            }
            # code...
        }

        

        // print_r($listData);
        // die();
        return $listData;
    }

    public function entraceReports($value, $type){

        $sql = "SELECT * FROM payments";
        $getRecs;
        if( $type == 'Monthly' ){
            # Montly report
            $sql .= " WHERE isIntrance = true AND MONTH(createdDate) = MONTH(CURRENT_DATE()) AND YEAR(createdDate) = YEAR(CURRENT_DATE()) ORDER BY createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Yearly') {
            # Yearly report
            $sql .= " WHERE isIntrance = true AND YEAR(createdDate) = YEAR(CURRENT_DATE()) ORDER BY createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Weekly') {
            # Yearly report
            $sql .= " WHERE isIntrance = true AND YEARWEEK(`createdDate`, 1) = YEARWEEK(CURDATE(), 1) ORDER BY createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }else{
            # custom date select
            # date1-date2
            $exploded = explode(",", $value);
            $dateFrom = $exploded[0];
            $dateTo = $exploded[1];
            $sql .= " WHERE isIntrance = true AND createdDate >= :dateFrom AND createdDate <= :dateTo ORDER BY createdDate ASC";

            $getRecs = $this->dynamicSLCTLabeledQuery($sql, array(
                ':dateFrom' => $dateFrom,
                ':dateTo' => $dateTo
            ));
        }
        $data = $getRecs['data']->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function cottagesReports($value, $type){

        $sql = "SELECT * FROM reservation_facility LEFT JOIN facility ON facility.Facility_id = reservation_facility.facilityId LEFT JOIN reservation ON reservation.Reservation_id = reservation_facility.reservationId";
        $getRecs;
        if( $type == 'Monthly' ){
            # Montly report
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND facility.Category = 'Cottages' AND MONTH(reservation_facility.createdDate) = MONTH(CURRENT_DATE()) AND YEAR(reservation_facility.createdDate) = YEAR(CURRENT_DATE()) ORDER BY reservation_facility.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Yearly') {
            # Yearly report
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND facility.Category = 'Cottages' AND YEAR(reservation_facility.createdDate) = YEAR(CURRENT_DATE()) ORDER BY reservation_facility.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Weekly') {
            # Yearly report
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND facility.Category = 'Cottages' AND YEARWEEK(reservation_facility.createdDate, 1) = YEARWEEK(CURDATE(), 1) ORDER BY reservation_facility.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }else{
            # custom date select
            # date1-date2
            $exploded = explode(",", $value);
            $dateFrom = $exploded[0];
            $dateTo = $exploded[1];
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND facility.Category = 'Cottages' AND reservation_facility.createdDate >= :dateFrom AND reservation_facility.createdDate <= :dateTo ORDER BY reservation_facility.createdDate ASC";

            $getRecs = $this->dynamicSLCTLabeledQuery($sql, array(
                ':dateFrom' => $dateFrom,
                ':dateTo' => $dateTo
            ));
        }
        $data = $getRecs['data']->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function entertainmentReports($value, $type){

        $sql = "SELECT * FROM reservation_facility LEFT JOIN facility ON facility.Facility_id = reservation_facility.facilityId LEFT JOIN reservation ON reservation.Reservation_id = reservation_facility.reservationId";
        $getRecs;
        if( $type == 'Monthly' ){
            # Montly report
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND facility.Category = 'Entertainment' AND MONTH(reservation_facility.createdDate) = MONTH(CURRENT_DATE()) AND YEAR(reservation_facility.createdDate) = YEAR(CURRENT_DATE()) ORDER BY reservation_facility.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Yearly') {
            # Yearly report
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND facility.Category = 'Entertainment' AND YEAR(reservation_facility.createdDate) = YEAR(CURRENT_DATE()) ORDER BY reservation_facility.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Weekly') {
            # Yearly report
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND facility.Category = 'Entertainment' AND YEARWEEK(reservation_facility.createdDate, 1) = YEARWEEK(CURDATE(), 1) ORDER BY reservation_facility.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }else{
            # custom date select
            # date1-date2
            $exploded = explode(",", $value);
            $dateFrom = $exploded[0];
            $dateTo = $exploded[1];
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND facility.Category = 'Entertainment' AND reservation_facility.createdDate >= :dateFrom AND reservation_facility.createdDate <= :dateTo ORDER BY reservation_facility.createdDate ASC";

            $getRecs = $this->dynamicSLCTLabeledQuery($sql, array(
                ':dateFrom' => $dateFrom,
                ':dateTo' => $dateTo
            ));
        }
        $data = $getRecs['data']->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function reservationReports($value, $type){

        $sql = "SELECT 
                    * 
                FROM 
                    reservation 
                LEFT JOIN 
                    customer 
                ON 
                    reservation.Customer_id = customer.customer_id ";
        $getRecs;
        if( $type == 'Monthly' ){
            # Montly report
            $sql .= " WHERE MONTH(reservation.createdDate) = MONTH(CURRENT_DATE()) AND YEAR(reservation.createdDate) = YEAR(CURRENT_DATE()) ORDER BY reservation.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Yearly') {
            # Yearly report
            $sql .= " WHERE YEAR(reservation.createdDate) = YEAR(CURRENT_DATE()) ORDER BY reservation.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Weekly') {
            # Yearly report
            $sql .= " WHERE YEARWEEK(reservation.createdDate, 1) = YEARWEEK(CURDATE(), 1) ORDER BY reservation.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }else{
            # custom date select
            # date1-date2
            $exploded = explode(",", $value);
            $dateFrom = $exploded[0];
            $dateTo = $exploded[1];
            $sql .= " WHERE reservation.createdDate >= :dateFrom AND reservation.createdDate <= :dateTo ORDER BY reservation.createdDate ASC";

            $getRecs = $this->dynamicSLCTLabeledQuery($sql, array(
                ':dateFrom' => $dateFrom,
                ':dateTo' => $dateTo
            ));
        }
        
        $reservationData = $getRecs['data']->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        foreach ($reservationData as $data) {

            $innerArr = array(
                'date' => date('M. d Y', strtotime($data['createdDate'])),
                'customer' => $data['FirstName'] . ' ' . $data['LastName'],
                'numberOfCustomer' => $data['Number_of_guest'],
                'status' => $data['Reservation_status'],
                'reservationId' => $data['Reservation_id'],
                'customerId' => $data['customer_id'],
                'paymentStatus' => $data['paymentStatus']
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
                        'facilityDate' => date('M. d Y', strtotime($facility['dateIn'])) . ' to ' . date('M. d Y', strtotime($facility['dateOut'])),
                        'facilityId' => $facility['facilityId']
                    )
                );
            }
            $innerArr['totalAmountFac'] = $totalAmountFac;
            $innerArr['facilities'] = $facilitiesArr;
            array_push($list, $innerArr);
        }

        // echo '<pre>';
        // var_dump($list);
        // die();
        return $list;
    }


    public function reservationPaymentsReports($value, $type){

        $sql = "SELECT 
                    * 
                FROM 
                    reservation 
                LEFT JOIN 
                    customer 
                ON 
                    reservation.Customer_id = customer.customer_id ";
        $getRecs;
        if( $type == 'Monthly' ){
            # Montly report
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND MONTH(reservation.createdDate) = MONTH(CURRENT_DATE()) AND YEAR(reservation.createdDate) = YEAR(CURRENT_DATE()) ORDER BY reservation.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Yearly') {
            # Yearly report
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND YEAR(reservation.createdDate) = YEAR(CURRENT_DATE()) ORDER BY reservation.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Weekly') {
            # Yearly report
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND YEARWEEK(reservation.createdDate, 1) = YEARWEEK(CURDATE(), 1) ORDER BY reservation.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }else{
            # custom date select
            # date1-date2
            $exploded = explode(",", $value);
            $dateFrom = $exploded[0];
            $dateTo = $exploded[1];
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND reservation.createdDate >= :dateFrom AND reservation.createdDate <= :dateTo ORDER BY reservation.createdDate ASC";

            $getRecs = $this->dynamicSLCTLabeledQuery($sql, array(
                ':dateFrom' => $dateFrom,
                ':dateTo' => $dateTo
            ));
        }
        
        $reservationData = $getRecs['data']->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        foreach ($reservationData as $data) {

            $innerArr = array(
                'date' => date('M. d Y', strtotime($data['createdDate'])),
                'customer' => $data['FirstName'] . ' ' . $data['LastName'],
                'numberOfCustomer' => $data['Number_of_guest'],
                'status' => $data['Reservation_status'],
                'reservationId' => $data['Reservation_id'],
                'customerId' => $data['customer_id'],
                'paymentStatus' => $data['paymentStatus']
            );
            // array_push($list, );
            $str = "SELECT * FROM payments WHERE Reservation_id = :reservationId";
        
            $param = array(
                ':reservationId' => $data['Reservation_id']
            );
            $getPayments = $this->dynamicSLCTLabeledQuery($str, $param);
            $payments = $getPayments['data']->fetchAll(PDO::FETCH_ASSOC);
            $totalPaid = 0;
            foreach ($payments as $paymentKey => $payment) {
                $totalPaid += $payment['Amount'];
            }
            $innerArr['totalPaid'] = $totalPaid;
            array_push($list, $innerArr);
        }
        // echo '<pre>';
        // var_dump($list);
        // die();
        return $list;
    }
    

    public function roomsReports($value, $type){

        $sql = "SELECT * FROM reservation_facility LEFT JOIN facility ON facility.Facility_id = reservation_facility.facilityId LEFT JOIN reservation ON reservation.Reservation_id = reservation_facility.reservationId";
        $getRecs;
        if( $type == 'Monthly' ){
            # Montly report
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND facility.Category = 'Rooms' AND MONTH(reservation_facility.createdDate) = MONTH(CURRENT_DATE()) AND YEAR(reservation_facility.createdDate) = YEAR(CURRENT_DATE()) ORDER BY reservation_facility.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Yearly') {
            # Yearly report
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND facility.Category = 'Rooms' AND YEAR(reservation_facility.createdDate) = YEAR(CURRENT_DATE()) ORDER BY reservation_facility.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }elseif ($type == 'Weekly') {
            # Yearly report
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND facility.Category = 'Rooms' AND YEARWEEK(reservation_facility.createdDate, 1) = YEARWEEK(CURDATE(), 1) ORDER BY reservation_facility.createdDate ASC";
            $getRecs = $this->dynamicSLCTQuery($sql);

        }else{
            # custom date select
            # date1-date2
            $exploded = explode(",", $value);
            $dateFrom = $exploded[0];
            $dateTo = $exploded[1];
            $sql .= " WHERE reservation.paymentStatus != 'Unpaid' AND facility.Category = 'Rooms' AND reservation_facility.createdDate >= :dateFrom AND reservation_facility.createdDate <= :dateTo ORDER BY reservation_facility.createdDate ASC";

            $getRecs = $this->dynamicSLCTLabeledQuery($sql, array(
                ':dateFrom' => $dateFrom,
                ':dateTo' => $dateTo
            ));
        }
        $data = $getRecs['data']->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    

    public function addEntranceFee(){
        $customerId = $_POST['customerId'];
        if($_POST['customerId'] == ''){
            $qryCustomer = 'INSERT INTO customer(FirstName, MiddleName, LastName)VALUES(:FirstName, :MiddleName, :LastName)';
        
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $middlename = $_POST['middlename'];
            $placeholderCustomer = array(
                ':FirstName' => $firstname,
                ':MiddleName' => $middlename, 
                ':LastName' => $lastname
            );
            $insertCus = $this->dynamicDMLLabeledQuery($qryCustomer, $placeholderCustomer);
            $customerId = $insertCus['id'];
        }
        
        $insertBillingSQL = 'INSERT INTO billing(ReservationId, CustomerId, TotalBill, isIntrance, PaymentMode)VALUES(:ReservationId, :CustomerId, :TotalBill, :isIntrance, :PaymentMode)';
        $insertPaymentSQL = 'INSERT INTO payments(Customer_id, Reservation_id, Status, Amount, type, isIntrance, numberOfAdults, numberOfChildrens, numberOfGuests)VALUES(:Customer_id, :Reservation_id, :Status, :Amount, :type, :isIntrance, :numberOfAdults, :numberOfChildrens, :numberOfGuests)';

        $insertBilling = $this->dynamicDMLLabeledQuery($insertBillingSQL, array(
            ':ReservationId' => $_POST['Reservation'], 
            ':CustomerId' => $customerId,
            ':TotalBill' => $_POST['totalPayment'],
            ':isIntrance' => true,
            ':PaymentMode' => 'Manual'
        ));

        $insertPayment = $this->dynamicDMLLabeledQuery($insertPaymentSQL, array(
            ':Customer_id' => $customerId,
            ':Reservation_id' => $_POST['Reservation'],
            ':Status' => 'Success', 
            ':Amount' =>  $_POST['totalPayment'], 
            ':type' => 'Manual',
            ':isIntrance' => true,
            ':numberOfAdults' => $_POST['countAdult'], 
            ':numberOfChildrens' => $_POST['countChild'],
            ':numberOfGuests' => $_POST['numberOf']
        ));


        $updateReservationSQL = 'UPDATE reservation set Number_of_guest = :Number_of_guest,  number_of_adults = :number_of_adults, number_of_children = :number_of_children WHERE Reservation_id =:Reservation_id';

        $updateRes = $this->dynamicDMLLabeledQuery($updateReservationSQL, array(
            ':Number_of_guest' => $_POST['numberOf'],
            ':number_of_adults' => $_POST['countAdult'],
            ':number_of_children' => $_POST['countChild'],
            ':Reservation_id' => $_POST['Reservation']
        ));
        
        return [
            'status' => 'success'
        ];
    }
    public function getThepassUser(){
        $usr = 'SELECT * FROM user WHERE User_id =:UserId AND Password =:oldPass';
        $usrDetails = $this->dynamicSLCTLabeledQuery($usr, array(
            ':UserId' => $_POST['userId'],
            ':oldPass' => $_POST['oldPass']
        ));
        if($usrDetails['status'] == 'success'){
            return $usrDetails['data']->fetch(PDO::FETCH_ASSOC);
        }else{
            return ['status' => 'error'];
        }
        
    }
    public function updateThePass(){
        $updatePassSQL = 'UPDATE user set Password = :pass WHERE User_id = :Userid';
        $updateRes = $this->dynamicDMLLabeledQuery($updatePassSQL, array(
            ':pass' => $_POST['newPass'],
            ':Userid' => $_POST['userId']
        ));
        return $updateRes;
    }

    public function updateUserProfile(){
        $updatePassSQL = 'UPDATE user set LastName = :LastName, FirstName = :FirstName, Username = :Username WHERE User_id = :Userid';
        $updateRes = $this->dynamicDMLLabeledQuery($updatePassSQL, array(
            ':LastName' => $_POST['lastname'],
            ':FirstName' => $_POST['firstname'],
            ':Username' => $_POST['username'],
            ':Userid' => $_POST['userId']
        ));
        $_SESSION['user_data']['FirstName'] = $_POST['firstname'];
        $_SESSION['user_data']['LastName'] = $_POST['lastname'];
        $_SESSION['user_data']['Username'] = $_POST['username'];
        return $updateRes;

    }

    public function getAminities(){
        $sql = "SELECT * FROM aminities";
        $ret = $this->dynamicSLCTQuery($sql);
        return $ret['data']->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveAminities(){
        $sql = "INSERT into aminities(Name, price) VALUES (:Name, :price)";

        $ret = $this->dynamicDMLLabeledQuery($sql, array(
            ':Name' => $_POST['name'],
            ':price' => $_POST['price']
        ));
        return $ret;
    }

    public function editAminities(){
        $sql = "UPDATE aminities set Name = :Name , price = :price WHERE aminitiesId = :aminitiesId";

        $ret = $this->dynamicDMLLabeledQuery($sql, array(
            ':Name' => $_POST['edit_name'],
            ':price' => $_POST['edit_price'],
            ':aminitiesId' => $_POST['aminitiesId']
        ));
        return $ret;
    }

    public function deleteAmin(){
        $sql = "DELETE FROM aminities WHERE aminitiesId = :aminitiesId";

        $ret = $this->dynamicDMLLabeledQuery($sql, array(
            ':aminitiesId' => $_POST['aminitiesId']
        ));
        return $ret;
    }

    public function deactivateFacility(){

        $deactivate = $this->dynamicSLCTLabeledQuery("UPDATE facility set status = :status WHERE Facility_id =:facilityId", array(
            ':facilityId' => $_POST['facilityId'],
            ':status' => 'Deactivated'
        ));

        return [
            'status'    =>  'success'
        ];
    }

    public function approveReservation($resId){
        $deactivate = $this->dynamicSLCTLabeledQuery("UPDATE reservation set Reservation_status = :status WHERE Reservation_id =:Reservation_id", array(
            ':Reservation_id' => $resId,
            ':status' => 'Reserved'
        ));

        return [
            'status'    =>  'success'
        ];
    }

    public function getFacilityInfo($FacilitId){
        $facility = $this->dynamicSLCTLabeledQuery("SELECT * FROM facility WHERE Facility_id =:facilityId", array(
            ':facilityId' => $FacilitId
        ));
        return $facility['data']->fetch(PDO::FETCH_ASSOC);
    }

    public function getSpecificReservationWith($reservationId){
        // TODO:: calculate the payment based on days

        $sql = "SELECT 
                    * 
                FROM 
                    reservation 
                LEFT JOIN 
                    customer 
                ON 
                    reservation.Customer_id = customer.customer_id 
                WHERE
                    reservation.Reservation_id = :reservationId";
        $getRecs = $this->dynamicSLCTLabeledQuery($sql, array(
            ':reservationId' => $reservationId
        ));
        $reservationData = $getRecs['data']->fetchAll(PDO::FETCH_ASSOC);
        $innerArr = array();
        foreach ($reservationData as $data) {

            $innerArr = array(
                'date' => date('M. d Y', strtotime($data['createdDate'])),
                'customer' => ucfirst($data['FirstName']) . ' ' . ucfirst($data['LastName']),
                'numberOfCustomer' => $data['Number_of_guest'],
                'number_of_children' => $data['number_of_children'],
                'number_of_adults' => $data['number_of_adults'],
                'status' => $data['Reservation_status'],
                'reservationId' => $data['Reservation_id'],
                'customerId' => $data['customer_id'],
                'paymentStatus' => $data['paymentStatus'],
                'Event' => $data['Event']
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
                        'img' => $facility['Image'],
                        'facilityDate' => date('M. d Y', strtotime($facility['dateIn'])) . ' to ' . date('M. d Y', strtotime($facility['dateOut'])),
                        'facilityId' => $facility['facilityId']
                    )
                );
            }
            
            $innerArr['totalAmountFac'] = $totalAmountFac;
            $innerArr['facilities'] = $facilitiesArr;

        }
        // echo '<pre>';
        // var_dump($innerArr);
        // die();
        return $innerArr;

    }
    function getCategories(){

        $str = "SELECT 
                    * 
                FROM 
                    category";

        return $this->dynamicSLCTQuery($str);
    }

    function editCategory(){

        $str = "UPDATE category set Name = :name WHERE categoryId = :id";
        $param = array(
            ':name' => $_POST['name'],
            ':id' => $_POST['id']
        );
        
        return $this->dynamicDMLLabeledQuery($str, $param);

    }

    function createCategory(){

        $str = "INSERT INTO category (Name)Values(:name)";

        $param = array(
            ':name' => $_POST['name']
        );
        
        return $this->dynamicDMLLabeledQuery($str, $param);
        
    }
    
}
