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
                
                <input type="hidden" name="slider_id" id="slider_id" value="<?php echo $slider->id?>">
                
                <div class="form-group row"> 
                    <label for="banner" class="col-sm-2 text-right col-form-label"><?php echo display('banner')?> <i class="text-danger"> * </i>:</label>
                    <div class="col-sm-4">
                        <div class="">
                            <input type="file" name="banner" class="form-control" id="banner" placeholder="<?php echo display('banner')?>" value="<?php echo $customer->fax?>">
                            <input type="hidden" name="old_banner" id="old_banner" value="<?php echo $slider->image;?>">
                        </div>
                        <div style="margin: 15px 0px 15px 0px;">
                        <img width="400" src="<?= $slider->image?  base_url().''.$slider->image: '';?>" id="banner_preview">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><i>Recommended Size : 1200x400</i></small>
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
                    <label for="link" class="col-sm-2 text-right col-form-label"><?php echo display('enabled')?>:</label>
                    <div class="col-sm-4">
                        <div class="">
                            <input type="checkbox" value="1" <?=  $slider->enabled? 'checked': '' ?> name="link" class="checkbox checkbox-success text-center" id="featured" >
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-6 text-right">
                </div>
                <div class="col-sm-6 text-right">
                    <div class="">
                        <button type="button" onclick="slider_form()" class="btn btn-success">
                            <?php echo (empty($slider->id)?display('save'):display('update')) ?></button>
                    </div>
                </div>
            </div>
                <?php echo form_close();?>
            </div>

        </div>
    </div>
</div>
<script src="<?php echo base_url()?>my-assets/js/admin_js/bulletin.js" type="text/javascript"></script>
