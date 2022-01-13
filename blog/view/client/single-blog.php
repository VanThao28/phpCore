<?php 
include '../client/assets/inc/header.php';
include '../../controller/blogController.php';
$post = new blogController();
if(isset($_GET['id'])) {
   $id = $_GET['id'];
}
?>
     
   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 posts-list">
               <?php 
                   $get_id_post = $post->id_post($id);
                   if($get_id_post){
                       while($result = $get_id_post->fetch_assoc()){
               ?>
               <div class="single-post">
                  <div class="feature-img">
                  <img class="card-img rounded-0" src="<?php echo $result['image_post']?>" alt="">
                  </div>
                  <div class="blog_details">
                     <h2><?php echo $result['tbl_title']?></h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="#"><i class="fa fa-user"></i> <?php echo $result['tbl_name']?></a></li>
                     </ul>
                     <p class="excert"><?php echo $result['tbl_connent']?></p>
                  </div>
               </div>
               <?php 
                       }
                     }
               ?>
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->
<?php 
include '../client/assets/inc/footer.php';
?>     
</body>

</html>