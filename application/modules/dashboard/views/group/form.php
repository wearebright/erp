<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                
                <div class="panel-body">
                    <?= $group->id ? form_open_multipart("edit_group/$group->id"):form_open_multipart("add_group") ?>
                        
                        <?php echo form_hidden('id',$group->id) ?>
                        
                        <div class="form-group row">
                            <label for="firstname" class="col-sm-2 col-form-label text-d"><?php echo display('department') ?> <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="department_id">
                                    <option></option>
                                    <?php
                                        foreach ($departments as $key => $value) {
                                    ?>
                                    <option <?= $value->id === $group->department_id ? 'selected': '' ?> value="<?= $value->id ?>" ><?= $value->department_name ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-sm-2 col-form-label text-d"><?php echo display('group_name') ?> <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input name="group_name" class="form-control" type="text" placeholder="<?php echo display('group_name') ?>" id="lastname" value="<?php echo $group->group_name ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label text-d"><?php echo display('status')?> <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <?php echo form_radio('status', '1', (($group->status==1 || $group->status==null)?true:false), 'id="status"'); ?>Active
                                </label>
                                <label class="radio-inline">
                                    <?php echo form_radio('status', '0', (($group->status=="0")?true:false) , 'id="status"'); ?>Inactive
                                </label> 
                            </div>
                        </div>

                    
                        <div class="form-group text-right">
                            <a type="reset" href="/group_list" class="btn btn-primary w-md m-b-5"><?php echo display('cancel') ?></a>
                            <button type="submit"  class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
</div>


 