<div class="row">
    <div style="margin-bottom: 40px;">
        <a class="flex align-item-center" href="<?= base_url('bulletin_board') ?>">
            <i class="pe-7s-left-arrow fs-18 mr-10"></i> Back to Bulletin Board
        </a>
    </div>
    <div class="col-md-8 panel post-details">
        <h2><?= $postDetails->title ?></h2>
        <small>Posted on <?= date('F d, Y h:i A', strtotime($postDetails->created_at)) ?> by <?= $postDetails->name ?> </small>


        <div style="margin-top: 40px;" class="">
            <?php 
                if($postDetails->banner){
            ?>
                <img style="margin-bottom: 20px;"  width="100%" src="<?= base_url().$postDetails->banner ?>">
            <?php
                }
            ?>
            <?= $postDetails->description ?>
        </div>
        
        <?php
         if($postDetails->attachment){
        ?>
            <a target="_blank" class="btn btn-success"  style="margin-top: 40px;" href="<?= base_url().$postDetails->attachment ?>">View Attachement</a>
        <?php
         }
        ?>
        
        
</div>
    </div>
</div>