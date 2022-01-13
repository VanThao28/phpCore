<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="user-box">
        <div class="float-left">
            <img src="assets\images\users\avatar-1.jpg" alt="" class="avatar-md rounded-circle">
        </div>
        <div class="user-info">
            <a href="#"><?php echo Session::get('adminName')?></a>
            <p class=" m-0">Administrator</p>
        </div>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul class="metismenu" id="side-menu">

            <li class="menu-title">Navigation</li>

            <li>
                <a href="index.php">
                    <i class="fas fa-users"></i>
                    <span> Users </span>
                </a>
            </li>
            <li>
                <a href="show_post.php">
                    <i class="fas fa-book"></i>
                    <span> Post </span>
                </a>
            </li>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>


</div>