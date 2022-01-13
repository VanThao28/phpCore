<?php 
    include '../admin/assets/inc/header.php';
    include '../admin/assets/inc/side_menu.php';
    include '../../controller/adminUserController.php';

    $edit = new adminUserController();
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input_name = $_POST['form_input_name_edit'];
        $input_email = $_POST['form_input_email_edit'];
        $input_password = md5($_POST['form_input_password_edit']);
        $input_date = $_POST['form_input_date_edit'];

        $edit_user = $edit->update_user($id, $input_name, $input_email, $input_password, $input_date);
    }

?>
<?php ?>
        <div class="content-page">
            <div class="content">
                <!-- Start container-fluid -->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div>
                                <h4 class="header-title mb-3">Edit User!</h4>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if(isset($edit_user)){
                            echo $edit_user;
                        }
                        $get_id_edit_user = $edit->id_edit_user($id);
                        if($get_id_edit_user){
                            while($result = $get_id_edit_user->fetch_assoc()){
                    ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-5">
                                <form class="form-horizontal mt-3" action="" method="POST">
                                <div class="form-group row">
                                        <label for="inputEmail3" class="col-md-3 control-label">Name</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="form_input_name_edit" required placeholder="Name" value="<?php echo $result['tbl_name']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-md-3 control-label">Email</label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" id="inputEmail3" name="form_input_email_edit" required placeholder="Email"  value="<?php echo $result['tbl_email']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-md-3 control-label">Password</label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control" id="inputPassword3" name="form_input_password_edit" required placeholder="Password" value="<?php echo $result['tbl_password']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-md-3 control-label">Date</label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" name="form_input_date_edit" required placeholder="mm/dd/yyyy" value="<?php echo $result['tbl_date']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-end mb-0" style="margin-top: 15px;">
                                        <div class="col-md-9">
                                            <button type="submit" class="btn btn-info">EDIT USER</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php 
                           }
                        }
                    ?>
                    <!-- connent -->
                </div>
            </div>
        </div>
    </div>
    <!-- END wrapper -->
<?php 
    include '../admin/assets/inc/footer.php';
?>