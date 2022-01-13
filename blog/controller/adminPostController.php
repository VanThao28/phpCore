<?php 
    include_once '../../config/database.php';
    include_once '../../config/format.php';

    class adminPostController
    {
        private $bd;
        private $format;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function create_post($data,$files){
            $inputTitle = $this->fm->validation($data['form_input_title']);
            $inputConnent = $this->fm->validation($data['form_input_connent']);
            $inputCategory = $this->fm->validation($data['form_input_category']);
            $inputDate = $this->fm->validation($data['form_input_date']);

            $inputUser = mysqli_real_escape_string($this->db->link, $data['form_input_user']);
            $inputTitle = mysqli_real_escape_string($this->db->link, $inputTitle);
            $inputConnent = mysqli_real_escape_string($this->db->link, $inputConnent);
            $inputCategory = mysqli_real_escape_string($this->db->link, $inputCategory);
            $inputIsPublic = mysqli_real_escape_string($this->db->link, $data['form_input_is_public']);
            $inputDate = mysqli_real_escape_string($this->db->link, $inputDate);
            $permited = array('jpg','jpeg','png');
            $file_name = $_FILES['form_input_image']['name'];
            $file_size = $_FILES['form_input_image']['size'];
            $file_temp = $_FILES['form_input_image']['tmp_name'];
            
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
            $uploaded_image = "../admin/assets/images/image_blog/".$unique_image;

            if(empty($inputUser) || empty($inputTitle) || empty($inputConnent) || empty($inputCategory) || empty($inputDate) || empty($file_name)) {
               
                $alert = "
                <div class='alert alert-danger text-danger alert-dismissible fade show' role='alert'>
                <strong>Lỗi!</strong> title, connent và category date không bỏ trống.
                </div>
               ";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = " INSERT INTO post (btl_user_id,tbl_title, tbl_connent, image_post, tbl_category,is_public , tbl_date) VALUE ('$inputUser','$inputTitle', '$inputConnent', '$uploaded_image', '$inputCategory','$inputIsPublic', '$inputDate')";
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
        public function list_post(){
            $query = "SELECT post.*, users.tbl_name FROM post INNER JOIN users ON post.btl_user_id = users.id ORDER BY post.id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function list_user(){
            $query = "SELECT * FROM users  ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function id_edit_post($id){
            $query = "SELECT * FROM post WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_post($id,$data,$files){
            $inputTitle_edit = $this->fm->validation($data['form_input_title_edit']);
            $inputConnent_edit = $this->fm->validation($data['form_input_connent_edit']);
            $inputCategory_edit = $this->fm->validation($data['form_input_category_edit']);
            $inputDate_edit = $this->fm->validation($data['form_input_date_edit']);

            $id = mysqli_real_escape_string($this->db->link, $id);
            $inputUserEdit = mysqli_real_escape_string($this->db->link, $data['form_input_user_edit']);
            $inputTitleEdit = mysqli_real_escape_string($this->db->link, $inputTitle_edit);
            $inputConnentEdit = mysqli_real_escape_string($this->db->link, $inputConnent_edit);
            $inputCategoryEdit = mysqli_real_escape_string($this->db->link, $inputCategory_edit);
            $inputIsPublic_edit = mysqli_real_escape_string($this->db->link, $data['form_input_is_public_edit']);
            $inputDateEdit = mysqli_real_escape_string($this->db->link, $inputDate_edit);

            $permited_edit = array('jpg','jpeg','png');
            $file_name_edit = $_FILES['form_input_image_edit']['name'];
            $file_size_edit = $_FILES['form_input_image_edit']['size'];
            $file_temp_edit = $_FILES['form_input_image_edit']['tmp_name'];
            
            $div_edit = explode('.', $file_name_edit);
            $file_ext_edit = strtolower(end($div_edit));
            $unique_image_edit = substr(md5(time()), 0,10).'.'.$file_ext_edit;
            $uploaded_image_edit = "../admin/assets/images/image_blog/".$unique_image_edit;

            if(empty($inputTitleEdit) || empty($inputConnentEdit) || empty($inputCategoryEdit) || empty($inputDateEdit)) {
                $alert = "
                <div class='alert alert-danger text-danger alert-dismissible fade show' role='alert'>
                <strong>Lỗi!</strong> title, connent và category date không bỏ trống.
                </div>
               ";
                return $alert;
            } else {
                if(!empty($file_name_edit)){
                    //nếu chọn ảnh
                    if($file_size_edit > 20480){
                        $alert = " <div class='alert alert-danger text-danger alert-dismissible fade show' role='alert'>
                        <strong>Lỗi!</strong> kích thước ảnh lớn hơn 20MB.
                        </div>";
                        return $alert;
                    }
                    elseif(in_array($file_ext_edit, $permited_edit) === false){
                        $alert= " <div class='alert alert-danger text-danger alert-dismissible fade show' role='alert'>
                        <strong>Lỗi!</strong> bạn chỉ có thể tải lên.".implode(',',$permited_edit)."</div>";
                        return $alert;
                    }

                    $query = " UPDATE post SET btl_user_id='$inputUserEdit', tbl_title = '$inputTitleEdit', tbl_connent = '$inputConnentEdit',image_post = '$uploaded_image_edit' ,is_public = '$inputIsPublic_edit', tbl_date = '$inputDateEdit' WHERE id = '$id'";
                } else{
                    $query = " UPDATE post SET btl_user_id='$inputUserEdit', tbl_title = '$inputTitleEdit', tbl_connent = '$inputConnentEdit', tbl_category = '$inputCategoryEdit',is_public = '$inputIsPublic_edit', tbl_date = '$inputDateEdit' WHERE id = '$id'";
                }
            }
                move_uploaded_file($file_temp_edit, $uploaded_image_edit);
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
        public function delete_post($id){
            $query = "DELETE FROM post WHERE id = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "
                        <div class='alert alert-success text-success alert-dismissible fade show' role='alert'>
                            <strong>Thành công!</strong> xóa post thành công.
                        </div>
                ";
                return $alert;
            } else{
                $alert = "
                        <div class='alert alert-danger text-danger alert-dismissible fade show' role='alert'>
                            <strong>Lỗi!</strong> xóa post không thành công.
                        </div>
                ";
                return $alert;
            }
            return $result;
        }
    }
    
?>