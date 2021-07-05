<div class="row">
    <div style="margin-bottom: 40px;">
        <a class="flex align-item-center" href="<?= base_url('bulletin_board') ?>">
            <i class="pe-7s-left-arrow fs-18 mr-10"></i> Back to Bulletin Board
        </a>
    </div>
    <div class="col-md-10">
        <h3><?= $postDetails->title ?></h3>
        <p>Posted at <?= date('F d, Y h:i A', strtotime($postDetails->created_at)) ?> by <?= $postDetails->name ?> </p>

        <div style="margin-top: 40px;" class="">
            <?= $postDetails->description ?>
        </div>
</div>
    </div>
</div>