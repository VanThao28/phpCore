<?php 
    include_once '../../config/database.php';
    include_once '../../config/format.php';

    class adminUserController
    {
        private $bd;
        private $format;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function create_user($input_name, $input_email, $input_password, $input_date){
            $inputName = $this->fm->validation($input_name);
            $inputEmail = $this->fm->validation($input_email);
            $inputPassword = $this->fm->validation($input_password);
            $inputDate = $this->fm->validation($input_date);

            $inputName = mysqli_real_escape_string($this->db->link, $inputName);
            $inputEmail = mysqli_real_escape_string($this->db->link, $inputEmail);
            $inputPassword = mysqli_real_escape_string($this->db->link, $inputPassword);
            $inputDate = mysqli_real_escape_string($this->db->link, $inputDate);

            if(empty($inputName) || empty($inputEmail) || empty($inputPassword) || empty($inputDate)) {
               
                $alert = "
                <div class='alert alert-danger text-danger alert-dismissible fade show' role='alert'>
                <strong>Lỗi!</strong> name, email và password date không bỏ trống.
                </div>
               ";
                return $alert;
            } else {
                $query = " INSERT INTO users (tbl_name, tbl_email, tbl_password, tbl_date) VALUE ('$inputName', '$inputEmail', '$input_password', '$input_date')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "
                            <div class='alert alert-success text-success alert-dismissible fade show' role='alert'>
                                <strong>Thành công!</strong> thêm user thành công.
                            </div>
                    ";
                    return $alert;
                } else{
                    $alert = "
                            <div class='alert alert-danger text-danger alert-dismissible fade show' role='alert'>
                                <strong>Lỗi!</strong> thêm user không thành công.
                            </div>
                    ";
                    return $alert;
                }
            }
        } 
        public function list_user(){
            $query = "SELECT * FROM users ORDER BY id desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function id_edit_user($id){
            $query = "SELECT * FROM users WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_user($id, $input_name, $input_email, $input_password, $input_date){
            $inputName = $this->fm->validation($input_name);
            $inputEmail = $this->fm->validation($input_email);
            $inputPassword = $this->fm->validation($input_password);
            $inputDate = $this->fm->validation($input_date);

            $id = mysqli_real_escape_string($this->db->link, $id);
            $inputName = mysqli_real_escape_string($this->db->link, $inputName);
            $inputEmail = mysqli_real_escape_string($this->db->link, $inputEmail);
            $inputPassword = mysqli_real_escape_string($this->db->link, $inputPassword);
            $inputDate = mysqli_real_escape_string($this->db->link, $inputDate);

            if(empty($inputEmail) || empty($inputEmail) || empty($inputPassword) || empty($inputDate)) {
               
                $alert = "
                <div class='alert alert-danger text-danger alert-dismissible fade show' role='alert'>
                <strong>Lỗi!</strong> name, email và password date không bỏ trống.
            </div>
               ";
                return $alert;
            } else {
                $query = " UPDATE users SET tbl_name = '$inputName', tbl_email = '$inputEmail', tbl_password = '$inputPassword', tbl_date = '$inputDate' WHERE id = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "
                            <div class='alert alert-success text-success alert-dismissible fade show' role='alert'>
                                <strong>Thành công!</strong> sửa user thành công.
                            </div>
                    ";
                    return $alert;
                } else{
                    $alert = "
                            <div class='alert alert-danger text-danger alert-dismissible fade show' role='alert'>
                                <strong>Lỗi!</strong> sửa user không thành công.
                            </div>
                    ";
                    return $alert;
                }
            }
        } 
        public function delete_user($id){
            $query = "DELETE FROM users WHERE id = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "
                        <div class='alert alert-success text-success alert-dismissible fade show' role='alert'>
                            <strong>Thành công!</strong> xóa user thành công.
                        </div>
                ";
                return $alert;
            } else{
                $alert = "
                        <div class='alert alert-danger text-danger alert-dismissible fade show' role='alert'>
                            <strong>Lỗi!</strong> xóa user không thành công.
                        </div>
                ";
                return $alert;
            }
            return $result;
        }
    }
    
?>