<?php 
    include_once '../../config/session.php';
    include_once '../../config/database.php';
    include_once '../../config/format.php';
    Session::checkLogin();

    class adminLoginController
    {
        private $bd;
        private $format;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function login_admin($adminEmail, $adminPassword){
            $adminEmail = $this->fm->validation($adminEmail);
            $adminPassword = $this->fm->validation($adminPassword);

            $adminEmail = mysqli_real_escape_string($this->db->link, $adminEmail);
            $adminPassword = mysqli_real_escape_string($this->db->link, $adminPassword);

            if(empty($adminEmail) || empty($adminPassword)) {
                $alert = "email và password không bỏ trống";
                return $alert;
            } else {
                $query = " SELECT * FROM users WHERE tbl_email = '$adminEmail' AND tbl_password = '$adminPassword' LIMIT 1";
                $result = $this->db->select($query);

                if($result != false) {
                    $value = $result->fetch_assoc();
                    Session::set('adminLogin', true);
                    Session::set('adminId', $value['id']);
                    Session::set('adminEmail', $value['tbl_email']);
                    Session::set('adminName', $value['tbl_name']);
                    header('Location:index.php');
                } else {
                    $alert = "email và password không đúng";
                    return $alert;
                }
            }
        } 
    }
    
?>