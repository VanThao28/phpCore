<?php 
    include '../admin/assets/inc/header.php';
    include '../admin/assets/inc/side_menu.php';
    include '../../controller/adminUserController.php';

    $create = new adminUserController();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input_name = $_POST['form_input_name'];
        $input_email = $_POST['form_input_email'];
        $input_password = md5($_POST['form_input_password']);
        $input_date = $_POST['form_input_date'];

        $create_user = $create->create_user($input_name, $input_email, $input_password, $input_date);
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
                                <h4 class="header-title mb-3">Create User!</h4>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if(isset($create_user)){
                            echo $create_user;
                        }
                    ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-5">
                                <form class="form-horizontal mt-3" action="user_create.php" method="POST">
                                <div class="form-group row">
                                        <label for="inputEmail3" class="col-md-3 control-label">Name</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="form_input_name" required placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-md-3 control-label">Email</label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" id="inputEmail3" name="form_input_email" required placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-md-3 control-label">Password</label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control" id="inputPassword3" name="form_input_password" required placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-md-3 control-label">Date</label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" name="form_input_date" required placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-end mb-0" style="margin-top: 15px;">
                                        <div class="col-md-9">
                                            <button type="submit" class="btn btn-info">ADD USER</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- connent -->
                </div>
            </div>
        </div>
    </div>
    <!-- END wrapper -->
<?php 
    include '../admin/assets/inc/footer.php';
?>