 

<!-- Content Wrapper. Contains page content THIS IS NOT EDITED VERSION FOR product/create.php--> 

<!-- Content Wrapper. Contains page content -->
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
            <h3 class="box-title">Add Product</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                

                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>
              

              <div class="form-group">
                <label for="extraction">Extraction</label>
                  <select class="form-control" id="extraction" name="extraction">
                    <option value="2">No</option>
                    <option value="1">Yes</option>
                  </select>
              </div>

              <div class="form-group">
                  <label for="phytochem_analysis">Phytochemical Screening</label>
                   <select class="form-control" id="phytochem_analysis" name="phytochem_analysis">
                     <option value="2">No</option>
                     <option value="1">Yes</option>
                   </select>
              </div>

              <div class="form-group">
                <label for="antioxidant_assay">Antioxidant Assay</label>
                <select class="form-control" id="antioxidant_assay" name="antioxidant_assay">
                  <option value="2">No</option>
                  <option value="1">Yes</option>
                </select>
              </div>


            <div class="form-group">
              <label for="tlc">Thin Layer Chromatography</label>
              <select class="form-control" id="tlc" name="tlc">
                <option value="2">No</option>
                <option value="1">Yes</option>
              </select>
            </div>

            <div class="form-group">
              <label for="t_flavonoid">Total Flavonoid Content</label>
                <select class="form-control" id="t_flavonoid" name="t_flavonoid">
                   <option value="2">No</option>
                   <option value="1">Yes</option>
                </select>
          </div>

          <div class="form-group">
              <label for="t_phenolic_content">Total Phenolic Content</label>
              <select class="form-control" id="t_phenolic_content" name="t_phenolic_content">
                <option value="2">No</option>
                <option value="1">Yes</option>
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
        <!-- /.box HERE -->
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
    $("#addProductNav").addClass('active');

  });
</script>