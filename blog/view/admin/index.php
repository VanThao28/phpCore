<?php 
    include '../admin/assets/inc/header.php';
    include '../admin/assets/inc/side_menu.php';
    include '../../controller/adminUserController.php';
    $user = new adminUserController();
    $show_user = $user->list_user();
    if(isset($_GET['delid'])) {
        $id = $_GET['delid'];
        $del_user = $user->delete_user($id);
    }
?>
        <div class="content-page">
            <div class="content">

                <!-- Start container-fluid -->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div>
                                <h4 class="header-title mb-3">User!</h4>
                            </div>
                        </div>
                    </div>
                    <?php 
                         if(isset($del_user)){
                            echo "<script>window.location='index.php'</script>".$del_user;
                        }
                    ?>
                    <div class="row">
                    <div class="col-12">
                        <div>
                            <div>
                                <div class="button-list">
                                    <a href="user_create.php" class="btn btn-icon btn-success" style="margin-bottom: 15px;"> <i class="fas fa-plus"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 168px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Id</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 168px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 256px;" aria-label="Position: activate to sort column ascending">Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 256px;" aria-label="Position: activate to sort column ascending">Date</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 168px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Setting</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <?php 
                                        if($show_user) {
                                            $i=0;
                                            while($result = $show_user->fetch_assoc()){
                                                $i++;
                                    ?>
                                    <tr role="row" class="odd">
                                        <td tabindex="0" class="sorting_1"><?php echo $i?></td>
                                        <td><?php echo $result['tbl_name']?></td>
                                        <td><?php echo $result['tbl_email']?></td>
                                        <td><?php echo $result['tbl_date']?></td>
                                        <td>
                                            <a href="user_edit.php?id=<?php echo $result['id']?>" class="btn btn-icon btn-warning" style="margin-bottom: 5px;"> <i class="fas fa-edit"></i> </a>
                                            <a onclick="return confirm('are you want to delete?')" href="?delid=<?php echo $result['id']?>" class="btn btn-icon btn-danger" style="margin-bottom: 5px;"> <i class="fas fa-trash-alt"></i> </a>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
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