<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo $title ?> </h4>
                </div>
            </div>
            
            <div class="panel-body">
                <?php echo form_open_multipart('','class="" id="announcement_form"')?>
                
                <input type="hidden" name="announcement_id" id="announcement_id" value="<?php echo $announcement->id?>">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 text-right col-form-label"><?php echo display('title')?> <i class="text-danger"> * </i>:</label>
                    <div class="col-sm-6">
                        <div class="">
                            <input type="text" name="title" class="form-control" id="title" placeholder="<?php echo display('title')?>" value="<?php echo $announcement->title?>">
                            <!-- <input type="hidden" name="old_title" value="<?php echo $announcement->title?>"> -->
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="address1" class="col-sm-2 text-right col-form-label"><?php echo display('description')?> <i class="text-danger"> * </i>:</label>
                    <div class="col-sm-6">
                        <div class="">
                            <textarea rows="7" name="description" id="description" class="form-control" placeholder="<?php echo display('description')?>"><?php echo $announcement->description?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <label for="banner" class="col-sm-2 text-right col-form-label"><?php echo display('banner')?>:</label>
                    <div class="col-sm-6">
                        <div class="">
                            <input type="file" name="banner" class="form-control" id="banner" placeholder="<?php echo display('banner')?>" value="<?php echo $customer->fax?>">
                            <input type="hidden" name="old_banner" id="old_banner" value="<?php echo $announcement->banner;?>">
                        </div>
                        <div style="margin: 15px 0px 15px 0px;">
                            <img width="400" src="<?= $announcement->banner?  base_url().''.$announcement->banner: '';?>" id="banner_preview">
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <label for="attachment" class="col-sm-2 text-right col-form-label"><?php echo display('attachment')?>:</label>
                    <div class="col-sm-6">
                        <div class="flex">
                            <input type="file" name="attachment" class="form-control" id="attachment" placeholder="<?php echo display('attachment')?>">
                            <input type="hidden" name="old_attachment" id="old_attachment" value="<?php echo $announcement->attachment;?>">
                        </div>
                        <?php 
                            if($announcement->attachment){
                        ?>
                        <div style="margin: 15px 0px 15px 0px;">
                            <a target="_blank" href="<?php echo base_url().''.$announcement->attachment;?>" id="banner_preview">View Attachment</a>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 text-right">
                </div>
                <div class="col-sm-6 text-right">
                    <div class="">
                        <button type="button" onclick="announcement_form()" class="btn btn-success">
                            <?php echo (empty($announcement->id)?display('save'):display('update')) ?></button>
                    </div>
                </div>
            </div>
                <?php echo form_close();?>
            </div>

        </div>
    </div>
</div>
<script src="<?php echo base_url()?>my-assets/js/admin_js/bulletin.js" type="text/javascript"></script>
