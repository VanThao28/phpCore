<?php 
    include '../admin/assets/inc/header.php';
    include '../admin/assets/inc/side_menu.php';
    include '../../controller/adminPostController.php';
    include '../../controller/adminUserController.php';

    $edit = new adminPostController();
    $user = new adminUserController();
    $user_list = $user->list_user();
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $edit_post = $edit->update_post($id,$_POST,$_FILES);
    }

?>
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
                    if(isset($edit_post)){
                        echo $edit_post;
                    }
                    $get_id_edit_post = $edit->id_edit_post($id);
                    if($get_id_edit_post){
                        while($result = $get_id_edit_post->fetch_assoc()){
                ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mt-5">
                            <form class="form-horizontal mt-3"  method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                    <label class="col-md-3 control-label">User</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="form_input_user_edit">
                                        <?php 
                                            if($user_list) {
                                                while($result_user = $user_list->fetch_assoc()){
                                        ?>
                                            <option
                                            <?php 
                                                if($result_user['id'] == $result['btl_user_id']){
                                                     echo 'selected';
                                                    }
                                            ?>
                                            value="<?php echo $result_user['id']?>"><?php echo $result_user['tbl_name']?></option>
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
                                        <textarea class="form-control" name="form_input_title_edit" rows="4" cols="50" required placeholder="Name"><?php echo $result['tbl_title']?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Connent</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="form_input_connent_edit" rows="4" cols="50" required placeholder="Connent"><?php echo $result['tbl_connent']?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Upload file</label>
                                    <div class="col-md-9">
                                        <input type="file" accept="image/*" name="form_input_image_edit" onchange="loadFile(event)">
                                        <img id="output" src="<?php echo $result['image_post']?>" style="width: 100px;"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Category</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="form_input_category_edit" required placeholder="Category" value="<?php echo $result['tbl_category']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-md-3 control-label">Date</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="form_input_date_edit" required placeholder="mm/dd/yyyy" value="<?php echo $result['tbl_date']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-9">
                                    <div class="radio radio-success">

                                        <input type="radio" name="form_input_is_public_edit" id="radio4" value="0" <?php if($result['is_public']==0){echo 'checked';}?>>
                                        <label for="radio4">
                                            Hiện
                                        </label>
                                    </div>
                                    <div class="radio radio-danger">
                                        <input type="radio" name="form_input_is_public_edit" id="radio6" value="1" <?php if($result['is_public']==1){echo 'checked';}?>>
                                        <label for="radio6">
                                            Ẩn
                                        </label>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-end mb-0" style="margin-top: 15px;">
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-info">EDIT POST</button>
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