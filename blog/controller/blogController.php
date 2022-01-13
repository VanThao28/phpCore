<?php 
    include_once '../../config/database.php';
    include_once '../../config/format.php';

    class blogController
    {
        private $bd;
        private $format;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function show_post(){
            $query = "SELECT post.*, users.tbl_name FROM post INNER JOIN users ON post.btl_user_id = users.id WHERE is_public = 0 ORDER BY post.id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function id_post($id){
            $query = "SELECT post.*, users.tbl_name FROM post INNER JOIN users ON post.btl_user_id = users.id WHERE post.id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
    }
    
?>