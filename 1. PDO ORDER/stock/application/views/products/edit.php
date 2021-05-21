<!-- Content Wrapper. Contains page content  UNEDITED EDIT.PHP-->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Natural Products
      <small>Natural Products</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Natural Products</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Edit Natural Product</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

            <div class="form-group">
            <label for="pick_file_upload">Uploads</label>
            <select class="form-control" id="pick_file_upload" name="pick_file_upload">
              <option> Choose a file to upload</option>?>
            <?php if($product_data['extraction'] == 1 || $product_data['extraction'] == 3) { echo '<option value="1">1 -- Extraction Certificate of Analysis</option>';}?>
            <?php if($product_data['phytochem_analysis'] == 1 || $product_data['phytochem_analysis'] == 3) { echo '<option value="2">2 -- Phytochemical Analysis Certificate of Analysis</option>';}?>
            <?php if($product_data['antioxidant_assay'] == 1 || $product_data['antioxidant_assay'] == 3) { echo '<option value="3">3 -- Antioxidant Assay Certificate of Analysis</option>';}?> <!-- Use table name-->
            <?php if($product_data['tlc'] == 1 || $product_data['tlc'] == 3) { echo '<option value="4">4 -- Thin Layer Chromatograph Certificate of Analysis</option>';}?>
            <?php if($product_data['t_flavonoid'] == 1 || $product_data['t_flavonoid'] == 3) { echo '<option value="5">5 -- Total Flavonoid Content Certificate of Analysis</option>';}?>
            <?php if($product_data['t_phenolic_content'] == 1 || $product_data['t_phenolic_content'] == 3) { echo '<option value="6">6 -- Total Phenolic Content Certificate of Analysis</option>';}?>
              
            </select>
          </div>
                <!-- Extraction Div-->
                <div class="form-group" id = "extraction_div" name = "extraction_div">
                  <label for="extraction_cert">Extraction Certifictate of Analysis Upload</label>
                  <div class="kv-avatar" >
                      <div class="file-loading">
                          <input id="extraction_file" name="extraction_file" type="file">
                      </div>
                  </div>
                </div>
                  <div class="form-group" id = "extract_upload_div" name = "extract_upload_div">
                    <label for="extraction">Extraction Status</label>
                      <select class="form-control" id="extraction" name="extraction">
                        <option value="1" <?php if($product_data['extraction'] == 1) { echo "selected='selected'"; } ?>>Pending</option>
                        <option value="2" <?php if($product_data['extraction'] == 2) { echo "selected='selected'"; } ?>>Disable</option>
                        <option value="3" <?php if($product_data['extraction'] == 3) { echo "selected='selected'"; } ?>>Done</option>
                      </select>
                  </div>
                <!-- End of Extraction Div-->
                
                <!-- Pythochem Div-->
                 <div class="form-group" id = "phytochem_div" name = "phytochem_div">
                  <label for="pythochem_cert">Phytochemical Analysis Certifictate Upload</label>
                  <div class="kv-avatar" >
                      <div class="file-loading">
                          <input id="phytochemical_file" name="phytochemical_file" type="file">
                      </div>
                  </div>
                </div>
                  <div class="form-group" id = "phytochem_upload_div" name = "phytochem_upload_div">
                    <label for="phytochem_analysis">Phytochemical Analysis Status</label>
                      <select class="form-control" id="phytochem_analysis" name="phytochem_analysis">
                        <option value="1" <?php if($product_data['phytochem_analysis'] == 1) { echo "selected='selected'"; } ?>>Pending</option>
                        <option value="2" <?php if($product_data['phytochem_analysis'] == 2) { echo "selected='selected'"; } ?>>Disabled</option>
                        <option value="3" <?php if($product_data['phytochem_analysis'] == 3) { echo "selected='selected'"; } ?>>Done</option>
                      </select>
                  </div>
                  <!-- End of Pythochem Div-->


                <!-- Antioxidant Assay Div-->
                 <div class="form-group"  id = "antiox_div" name = "antiox_div">

                  <label for="antioxidant_cert">Antioxidant Assay</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="antioxidant_file" name="antioxidant_file" type="file">
                      </div>
                  </div>
                </div>
                  <div class="form-group" id = "antiox_upload_div" name = "antiox_upload_div">
                    <label for="antioxidant_assay">Antioxidant Assay Status</label>
                      <select class="form-control" id="antioxidant_assay" name="antioxidant_assay">
                        <option value="1" <?php if($product_data['antioxidant_assay'] == 1) { echo "selected='selected'"; } ?>>Pending</option>
                        <option value="2" <?php if($product_data['antioxidant_assay'] == 2) { echo "selected='selected'"; } ?>>Disabled</option>
                        <option value="3" <?php if($product_data['antioxidant_assay'] == 3) { echo "selected='selected'"; } ?>>Done</option>
                      </select>
                  </div>
                  <!-- End of Antioxidant Assay-->

                   <!-- TLC Div-->
                 <div class="form-group"  id = "tlc_div" name = "tlc_div">

                  <label for="tlc_cert">Thin Layer Chromatography</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="tlc_file" name="tlc_file" type="file">
                      </div>
                  </div>
                </div>
                  <div class="form-group" id = "tlc_upload_div" name = "tlc_upload_div">
                    <label for="tlc">Thin Layer Chromatography Status</label>
                      <select class="form-control" id="tlc" name="tlc">
                        <option value="1" <?php if($product_data['tlc'] == 1) { echo "selected='selected'"; } ?>>Pending</option>
                        <option value="2" <?php if($product_data['tlc'] == 2) { echo "selected='selected'"; } ?>>Disabled</option>
                        <option value="3" <?php if($product_data['tlc'] == 3) { echo "selected='selected'"; } ?>>Done</option>
                      </select>
                  </div>
                  <!-- End of TLC-->

                  <!-- flavonoid Div-->
                 <div class="form-group"  id = "t_flavonoid_div" name = "t_flavonoid_div">

                  <label for="t_flavonoid_cert">Thin Layer Chromatography</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="t_flavonoid_file" name="t_flavonoid_file" type="file">
                      </div>
                  </div>
                </div>
                  <div class="form-group" id = "t_flavonoid_upload_div" name = "tt_flavonoid_upload_div">
                    <label for="t_flavonoid">Thin Layer Chromatography Status</label>
                      <select class="form-control" id="t_flavonoid" name="t_flavonoid">
                        <option value="1" <?php if($product_data['t_flavonoid'] == 1) { echo "selected='selected'"; } ?>>Pending</option>
                        <option value="2" <?php if($product_data['t_flavonoid'] == 2) { echo "selected='selected'"; } ?>>Disabled</option>
                        <option value="3" <?php if($product_data['t_flavonoid'] == 3) { echo "selected='selected'"; } ?>>Done</option>
                      </select>
                  </div>
                  <!-- End of flavonoid-->

                    <div class="form-group"  id = "t_phenolic_content_upload_div" name = "t_phenolic_content_upload_div">

                  <label for="t_phenolic_content_cert">Total Phenolic Content</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="t_phenolic_content_file" name="t_phenolic_content_file" type="file">
                      </div>
                  </div>
                </div>
                  <div class="form-group" id = "t_phenolic_content_div" name = "t_phenolic_content_div">
                    <label for="t_phenolic_content_cert">Total Phenolic ContentStatus</label>
                      <select class="form-control" id="t_phenolic_content" name="t_phenolic_content">
                        <option value="1" <?php if($product_data['t_phenolic_content'] == 1) { echo "selected='selected'"; } ?>>Pending</option>
                        <option value="2" <?php if($product_data['t_phenolic_content'] == 2) { echo "selected='selected'"; } ?>>Disabled</option>
                        <option value="3" <?php if($product_data['t_phenolic_content'] == 3) { echo "selected='selected'"; } ?>>Done</option>
                      </select>
                  </div>
                  <!-- End of TLC-->

                <!--use this for status -->
                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1" <?php if($product_data['availability'] == 1) { echo "selected='selected'"; } ?>>Yes</option>
                    <option value="2" <?php if($product_data['availability'] != 1) { echo "selected='selected'"; } ?>>No</option>
                  </select>
                </div>

               



              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  
  $(document).ready(function() {
    $(".select_group").select2();
    $("#description").wysihtml5();

    $("#mainProductNav").addClass('active');
    $("#manageProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#extraction_file").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "pdf", "doc"]
    });

       var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#phytochemical_file").fileinput({
        overwriteInitial: true,
        maxFileSize: 2000,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "pdf","doc"]
    });

    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 

     $("#antioxidant_file").fileinput({ // must be the same as the name and id of input
        overwriteInitial: true,
        maxFileSize: 2000,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "pdf","doc"]
    });

     var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
     $("#tlc_file").fileinput({ // must be the same as the name and id of input
        overwriteInitial: true,
        maxFileSize: 2000,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "pdf","doc"]
    });

      var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 

     $("#t_flavonoid_file").fileinput({ // must be the same as the name and id of input
        overwriteInitial: true,
        maxFileSize: 2000,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "pdf","doc"]
    });

      var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
     $("#t_phenolic_content_file").fileinput({ // must be the same as the name and id of input
        overwriteInitial: true,
        maxFileSize: 2000,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "pdf","doc"]
    });

// shows the files that will be uplaoded one by one 
    $(document).ready(function (){
            $("#pick_file_upload").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() == "1") { 
                  // file upload
                  $("#extraction_div").show();
                    //$('#product_image').attr('required', '');
                    //$('#product_image').attr('data-error', 'This field is required.');
                    // status changer
                  $("#extract_upload_div").show();
                  $('#extraction').attr('required', '');
                  $('#extraction').attr('data-error', 'This field is required.');
                }else{
                  $("#extraction_div").hide();
                    // $('#product_image').removeAttr('required');
                    //$('#product_image').removeAttr('data-error');
                  $("#extract_upload_div").hide();
                  $('#extraction').removeAttr('required');
                  $('#extraction').removeAttr('data-error');
                } 
                if ($(this).val() == "2") {
                   $("#phytochem_div").show();
                   $("#phytochem_upload_div").show();
                   $('#phytochem_analysis').attr('required', '');
                  $('#phytochem_analysis').attr('data-error', 'This field is required.');
                }else{
                    $("#phytochem_div").hide();
                    $("#phytochem_upload_div").hide();
                    $('#phytochem_analysis').removeAttr('required');
                    $('#phytochem_analysis').removeAttr('data-error');
                } 
                if ($(this).val() == "3") {
                   $("#antiox_div").show();
                   $("#antiox_upload_div").show();
                   $('#antioxidant_assay').attr('required', '');
                  $('#antioxidant_assay').attr('data-error', 'This field is required.');
                }else{
                    $("#antiox_div").hide();
                    $("#antiox_upload_div").hide();
                    $('#antioxidant_assay').removeAttr('required');
                    $('#antioxidant_assay').removeAttr('data-error');
                } 
                 if ($(this).val() == "4") {
                   $("#tlc_div").show();
                   $("#tlc_upload_div").show();
                   $('#tlc').attr('required', '');
                  $('#tlc').attr('data-error', 'This field is required.');
                }else{
                    $("#tlc_div").hide();
                    $("#tlc_upload_div").hide();
                    $('#tlc').removeAttr('required');
                    $('#tlc').removeAttr('data-error');
                } 
                  if ($(this).val() == "5") {
                   $("#t_flavonoid_div").show();
                   $("#t_flavonoid_upload_div").show();
                   $('#t_flavonoid').attr('required', '');
                  $('#t_flavonoid').attr('data-error', 'This field is required.');
                }else{
                    $("#t_flavonoid_div").hide();
                    $("#t_flavonoid_upload_div").hide();
                    $('#t_flavonoid').removeAttr('required');
                    $('#t_flavonoid').removeAttr('data-error');
                } 
                 if ($(this).val() == "6") {
                   $("#t_phenolic_content_div").show();
                   $("#t_phenolic_content_upload_div").show();
                   $('#t_phenolic_content').attr('required', '');
                  $('#t_phenolic_content').attr('data-error', 'This field is required.');
                }else{
                    $("#t_phenolic_content_div").hide();
                    $("#t_phenolic_content_upload_div").hide();
                    $('#t_phenolic_content').removeAttr('required');
                    $('#t_phenolic_content').removeAttr('data-error');
                } 
            });
            $("#pick_file_upload").trigger("change");
        });

  });
</script>