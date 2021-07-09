<div class="row">

    <div class="col-md-12">
        <div class="roundbox">
            <div id="carousel" class="owl-carousel owl-theme">
                <?php
                    foreach($sliders as $slider){
                ?>
                    <div>
                        <a target="_blank" href="<?= $slider->link ?>">
                            <div class="slider-image" style="background-image: url(<?= $base_url.$slider->image ?>)">
                            </div>
                        </a>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
   
    <div class="col-md-8">
        <div style="margin-top: 40px; "></div>
        <h3><i class="ti-announcement" style="margin-right: 10px;"></i> Announcements</h3>
        <hr>
        <?php
            if(count($posts) > 0){
        ?>
            
            <?php
                foreach($posts as $post){
            ?>
            <div class="main_slides post">
                <div class="placeHolder" style="left: 0px;">
                    <a href="<?= base_url().'/announcement/'.$post->slug ?>">

                        <?php
                            if($post->banner){
                        ?>
                            <img class="object-fit-cover" src="<?= base_url().$post->banner ?>">
                            <div class="title_Container" style="margin-top: -85px;">
                                <p class="title"><?= $post->title ?></p>
                                <p class="datePosted">Posted on <?= date('F d, Y h:i A', strtotime($post->created_at)) ?> by <?= $post->name ?></p>
                            </div>
                        <?php
                            }else{
                        ?>
                            <img class="object-fit-cover" src="<?= base_url().$post->random_banner ?>">
                            <div class="title_Container2" style="margin-top: -85px;">
                                <div class="detailsContainer">
                                    <p class="title"><?= $post->title ?></p>
                                    <p class="description"><?= $post->description ?></p>
                                    <p class="datePosted">Posted on <?= date('F d, Y h:i A', strtotime($post->created_at)) ?> by <?= $post->name ?></p>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                    </a>
                </div>
            </div>
            <?php
                }
            ?>

            <?php
                if($totalPosts > 5){
            ?>
            <h2 class="load-more">Load More</h2>
            <?php
                }
            ?>
            <input type="hidden" id="row" value="0">
            <input type="hidden" id="all" value="<?php echo $totalPosts; ?>">
        <?php
            }else{
        ?>     
            <div class="empty-state">
                <img width="100" src="/my-assets/image/empty.svg">
                <h4 class="text-center"> No posted announcement yet </h4>
            </div>
        <?php
            }
        ?>
    </div> 
    <div class="col-md-4">
        <div style="margin-top: 40px; "></div>
        <div class="advertisement-image ">
            <?php
                if($stickyImage->image){
            ?>
            <a target="_blank" href="<?= $stickyImage->link ?>">
                <img class="object-fit-cover fixme" src="<?= base_url().$stickyImage->image ?>">
            </a>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>my-assets/js/admin_js/bulletin.js" type="text/javascript"></script>