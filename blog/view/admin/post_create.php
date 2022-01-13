<?php 
    include '../admin/assets/inc/header.php';
    include '../admin/assets/inc/side_menu.php';
    include '../../controller/adminPostController.php';
    include '../../controller/adminUserController.php';

    $create = new adminPostController();
    $user = new adminUserController();
    $user_list = $user->list_user();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $create_post = $create->create_post($_POST,$_FILES);
    }

?>
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
                    if(isset($create_post)){
                        echo $create_post;
                    }
                ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mt-5">
                            <form class="form-horizontal mt-3" action="post_create.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                    <label class="col-md-3 control-label">User</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="form_input_user">
                                        <?php 
                                            if($user_list) {
                                                while($result = $user_list->fetch_assoc()){
                                        ?>
                                            <option value="<?php echo $result['id']?>"><?php echo $result['tbl_name']?></option>
                                        <?php 
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Title</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="form_input_title" rows="4" cols="50" required placeholder="Name"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Connent</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="form_input_connent" rows="4" cols="50" required placeholder="Connent"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Upload file</label>
                                    <div class="col-md-9">
                                        <input type="file" accept="image/*" name="form_input_image" onchange="loadFile(event)">
                                        <img id="output"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Category</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="form_input_category" required placeholder="Category">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-md-3 control-label">Date</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="form_input_date" required placeholder="mm/dd/yyyy">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-9">
                                    <div class="radio radio-success">
                                        <input type="radio" name="form_input_is_public" id="radio4" value="0">
                                        <label for="radio4">
                                            Hiện
                                        </label>
                                    </div>
                                    <div class="radio radio-danger">
                                        <input type="radio" name="form_input_is_public" id="radio6" value="1">
                                        <label for="radio6">
                                            Ẩn
                                        </label>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-end mb-0" style="margin-top: 15px;">
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-info">ADD POST</button>
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