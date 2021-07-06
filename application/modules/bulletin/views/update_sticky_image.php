<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo $title ?> </h4>
                </div>
            </div>
            
            <div class="panel-body">
                <?php echo form_open_multipart('','class="" id="slider_form"')?>
                
                <input type="hidden" name="sticky_image_id" id="sticky_image_id" value="<?php echo $sticky_image->id?>">
                
                <div class="form-group row"> 
                    <label for="sticky_image" class="col-sm-2 text-right col-form-label"><?php echo display('image')?> <i class="text-danger"> * </i>:</label>
                    <div class="col-sm-4">
                        <div class="">
                            <input type="file" name="sticky_image" class="form-control" id="sticky_image">
                            <input type="hidden" name="old_sticky_image" id="old_sticky_image" value="<?php echo $sticky_image->image;?>">
                        </div>
                        <div style="margin: 15px 0px 15px 0px;">
                        <img width="400" src="<?= $sticky_image->image?  base_url().''.$sticky_image->image: '';?>" id="banner_preview">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="link" class="col-sm-2 text-right col-form-label"><?php echo display('link')?> :</label>
                    <div class="col-sm-4">
                        <div class="">
                            <input type="text" name="link" class="form-control" id="link" placeholder="<?php echo display('link')?>" value="<?php echo $slider->link?>">
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-6 text-right">
                </div>
                <div class="col-sm-6 text-right">
                    <div class="">
                        <button type="button" onclick="sticky_image_form()" class="btn btn-success">
                            <?php echo (empty($sticky_image->id)?display('save'):display('update')) ?></button>
                    </div>
                </div>
            </div>
                <?php echo form_close();?>
            </div>

        </div>
    </div>
</div>
<script src="<?php echo base_url()?>my-assets/js/admin_js/bulletin.js" type="text/javascript"></script>
