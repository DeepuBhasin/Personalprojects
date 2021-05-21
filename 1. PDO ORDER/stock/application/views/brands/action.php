 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Brands (Inventory)</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Brands</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Brand Detail</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <div class="row">
             <div class="col-md-6">
                <table class="table table-responsive table-hover">
                <tbody>
                  <tr><th>Code</th><td><?= $results['singleBrandIdData']->code?></td></tr>
                  <tr><th>Name</th><td><?= ucwords($results['singleBrandIdData']->name)?></td></tr>
                  <tr><th>Category</th><td><?= ucwords($results['singleBrandIdData']->category)?></td></tr>
                  <tr><th>Balance</th><td><?= $results['singleBrandIdData']->balance?></td></tr>
                </tbody>
              </table>
             </div>
          </div>
          
          <a class="btn btn-success" data-toggle="modal" href='#receive'>Receive</a>
          <div class="modal fade" id="receive">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Receive Brand </h4>
                </div>
                <div class="modal-body">
                 <form action="<?= base_url('brands/action')?>" method="POST" role="form">
                   <input type="hidden" name="variable" value="receive">
                   <input type="hidden" name="brand_id" value="<?= $results['singleBrandIdData']->id?>">
                   <div class="form-group">
                     <label for="amount">Receive Amount (g)</label>
                     <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Amount" required="">
                   </div>
                   <div class="form-group">
                     <label for="username">Username</label>
                     <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" required="">
                   </div>
                 
                   
                 
                   <button type="submit" name="actionButton" value="1" class="btn btn-primary">Submit</button>
                   <button type="reset" class="btn btn-danger">Clear</button>
                 </form> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


          <a class="btn btn-danger" data-toggle="modal" href='#weighed'>Weigh</a>
          <div class="modal fade" id="weighed">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Weighed Brand </h4>
                </div>
                <div class="modal-body">
                 <form action="<?= base_url('brands/action')?>" method="POST" role="form">
                   <input type="hidden" name="variable" value="weighed">
                   <input type="hidden" name="brand_id" value="<?= $results['singleBrandIdData']->id?>">
                   <div class="form-group">
                     <label for="amount">Weighed Amount (g)</label>
                     <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Amount" required="">
                   </div>
                   <div class="form-group">
                     <label for="username">Username</label>
                     <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" required="">
                   </div>
                 
                   
                 
                   <button type="submit" name="actionButton" value="1" class="btn btn-primary">Submit</button>
                   <button type="reset" class="btn btn-danger">Clear</button>
                 </form> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <br/><br/>
            <table id="brandDataTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Sri</th>
                <th>Created Date</th>
                <th>Receive (g)</th>
                <th>Weighed (g)</th>
                <th>Balance (g)</th>
               <th>User</th>
              </tr>
              </thead>
              <tbody>
                <?php $c=0; foreach($results['brandDataDetail'] as $pageData) {?>
                <tr>
                  <td><?= ++$c;?></td>
                  <td><?= $pageData->created_dt ?></td>
                  <td><?= $pageData->receive ?></td>
                  <td><?= $pageData->weighed ?></td>
                  <td><?= $pageData->balance ?></td>
                  <td><?= ucwords($pageData->username); ?></td>
                </tr>
                <?php }?>
              </tbody>

            </table>
          </div>
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
  $('#brandDataTable').DataTable({});
</script>
