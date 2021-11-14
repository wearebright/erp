<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                
                <div class="panel-body">
                <?php echo form_open_multipart("add_user/$user->user_id") ?>
                    
                    <?php echo form_hidden('id',$user->id) ?>
                    
                    <div class="form-group row">
                        <label for="firstname" class="col-sm-2 col-form-label text-d"><?php echo display('first_name') ?> <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                           <input name="firstname" class="form-control" type="text" placeholder="<?php echo display('first_name') ?>" id="firstname"  value="<?php echo $user->first_name ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lastname" class="col-sm-2 col-form-label text-d"><?php echo display('last_name') ?> <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input name="lastname" class="form-control" type="text" placeholder="<?php echo display('last_name') ?>" id="lastname" value="<?php echo $user->last_name ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label text-d"><?php echo display('email') ?> <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input name="email" class="form-control" type="text" placeholder="<?php echo display('email') ?>" id="email_id" value="<?php echo $user->email ?>">
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label text-d"><?php echo display('password') ?> <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input name="password" class="form-control" type="password" placeholder="<?php echo display('password') ?>" id="password">
                            <input name="oldpassword" class="form-control" type="hidden" value="<?php echo $user->password ?>">
                        </div>
                    </div>

                

                      <div class="form-group row">
                    <label for="preview" class="col-sm-2 col-form-label"><?php echo display('preview') ?></label>
                    <div class="col-sm-2">
                        <img src="<?php echo base_url(!empty($user->image) ? $user->image : "./assets/img/icons/default.jpg") ?>" class="img-thumbnail" width="125" height="100">
                    </div>
                    <div class="col-sm-7">

                    </div>
                    <input type="hidden" name="old_image" id="old_image" value="<?php echo $user->image ?>">
                </div> 
                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label"><?php echo display('image') ?></label>
                    <div class="col-sm-9">
                        <div>
                            <input type="file" name="image" id="edit_image" class="custom-input-file" />
                           
                        </div>
                    </div>
                </div> 

                    <div class="form-group row">
                        <label for="user_type" class="col-sm-2 col-form-label text-d"><?php echo display('user_type')?> <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                             <label class="radio-inline">
                                <?php echo form_radio('user_type', '0',(($user->user_type==0 || $user->user_type==null)?true:false) , 'id="user_type"'); ?>User
                            </label> 
                            <label class="radio-inline">
                                <?php echo form_radio('user_type', '1', (($user->user_type==1)?true:false), 'id="user_type"'); ?>Admin
                            </label>
                            <label class="radio-inline">
                                <?php echo form_radio('user_type', '2', (($user->user_type==1)?true:false), 'id="user_type"'); ?>Manager
                            </label>
                        </div>
                    </div>

                    <div class="form-group row" id="group_id">
                            <label for="group_id" class="col-sm-2 col-form-label text-d"><?php echo display('department') ?> </label>
                            <div class="col-sm-2">
                                <select onchange="getTeam()" name="department_id" class="form-control">
                                    <option <?= $user->department_id== 0?"selected":"" ?> value="">None</option>
                                    <?php 
                                        foreach ($departments as $key => $value) {
                                    ?>
                                            <option <?= $user->department_id === $value->id ? 'selected':'' ?> value="<?= $value->id ?>"><?= $value->department_name ?></option>
                                    <?php
                                        }
                                    ?>
                                </select> 
                            </div>
                    </div>

                    <div class="form-group row" id="group_id">
                        <label for="group_id" class="col-sm-2 col-form-label text-d"><?php echo display('group_name') ?> </label>
                        <div class="col-sm-2">
                            <select id="sales_team" class="form-control" name="group_id">
                                <option></option>
                                <?php
                                    foreach ($teams as $key => $value) {
                                ?>
                                <option <?= $value->id === $user->group_id ? 'selected': '' ?> value="<?= $value->id ?>" ><?= $value->group_name ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label text-d"><?php echo display('status')?> <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <?php echo form_radio('status', '1', (($user->status==1 || $user->status==null)?true:false), 'id="status"'); ?>Active
                            </label>
                            <label class="radio-inline">
                                <?php echo form_radio('status', '0', (($user->status=="0")?true:false) , 'id="status"'); ?>Inactive
                            </label> 
                        </div>
                    </div>
         
                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit"  class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>

<script>
    function getTeam(){
        var $dept = $('select[name=department_id] :selected').text();

        var base_url = $("#base_url").val();

        var myKeyVals = { department : $dept }

        $.ajax({
            url : base_url + "report/report/get_team_by_department/",
            data:myKeyVals, 
            type: "POST",
            dataType: "json",
            success: function(data)
            {
                $("#sales_team").empty();
                $("#sales_team").append('<option value="">None</option>');
                data.forEach((el, key) => {
                    $("#sales_team").append('<option value=' + el.id + '>' + el.group_name + '</option>');
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
</script>
 