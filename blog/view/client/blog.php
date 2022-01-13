<?php 
include '../client/assets/inc/header.php';
include '../../controller/blogController.php';
$post = new blogController();
$show_post = $post->show_post();
?>

<!--================Blog Area =================-->
<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    <?php 
                     if($show_post) {
                        while($result = $show_post->fetch_assoc()){
                    ?>
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="<?php echo $result['image_post']?>" alt="">
                            <a href="#" class="blog_item_date">
                                <p><?php echo $result['tbl_date']?></p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="single-blog.php?id=<?php echo $result['id']?>">
                                <h2><?php echo $result['tbl_title']?></h2>
                            </a>
                            <p><?php echo substr($result['tbl_connent'],0,50)?></p>
                            <ul class="blog-info-link">
                                <li><a href="#"><i class="fa fa-user"></i><?php echo $result['tbl_name']?></a></li>
                            </ul>
                        </div>
                    </article>
                    <?php 
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->

<?php 
    include '../client/assets/inc/footer.php';
?>
</body>
</html>