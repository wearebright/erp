<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo $title ?> </h4>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered" id="AnnouncementList">
                    <thead>
                        <tr>
                            <th><?php echo display('announcement_title') ?></th>
                            <th><?php echo display('uploaded_by'); ?></th>
                            <th><?php echo display('banner'); ?></th>
                            <th><?php echo display('posted_at') ?></th>
                            <th width="50px;"><?php echo display('action') ?> 
                            </th>
                        </tr>
                    </thead>
                    <tbody id="annoucement_tablebody">
                       
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>my-assets/js/admin_js/bulletin.js" type="text/javascript"></script>