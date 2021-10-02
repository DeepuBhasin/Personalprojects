<?php include_once('header.php');
$id = $_GET['id'];
$query = mysqli_query($con, "SELECT * FROM user where `user_id`=$id");
$row = mysqli_fetch_object($query);
?>
<div class="col-xs-12 col-sm-9 content">
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="content-row">
        <?php include_once('message.php'); ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title"><b>Edit Contact</b>
            </div>
          </div>
          <div class="panel-body">
            <form role="form" action="program_file.php" method="post">
              <input type="hidden" name="user_id" v value="<?= $row->user_id; ?>">
              <div class="form-group">
                <label for="media_option">Select Option *</label>
                <select class="form-control" name="media_option" required="" id="media_option">
                  <option value="">Select option </option>
                  <option value="sms" <?php if ($row->media_option == 'sms') {
                                        echo "SELECTED";
                                      } ?>>SMS </option>
                  <option value="voice" <?php if ($row->media_option == 'voice') {
                                          echo "SELECTED";
                                        } ?>>Voice </option>
                  <option value="both" <?php if ($row->media_option == 'both') {
                                          echo "SELECTED";
                                        } ?>>Both </option>

                </select>
              </div>
              <div class="form-group">
                <label for="last_name">Select Group *</label>
                <select class="form-control" name="group_id" required="">
                  <option value="">Select Group</option>
                  <?php
                  $query = mysqli_query($con, "SELECT * FROM group_table WHERE status=1 ORDER BY group_name ASC");
                  while ($a = mysqli_fetch_array($query)) { ?>
                    <option value="<?= $a['id'] ?>" <?php if ($row->group_id == $a['id']) {
                                                      echo "SELECTED";
                                                    } ?>><?= ucwords($a['group_name']); ?> </option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input type="text" class="form-control" name="full_name" id="full_name" required="required" autocomplete="off" placeholder="Enter Full Name *" value="<?= $row->full_name; ?> ">
              </div>
              <div class="form-group">
                <label for="last_name">Select Country *</label>
                <select class="form-control" name="country_id" required="">
                  <option value="">Select Country </option>
                  <?php
                  $query = mysqli_query($con, "SELECT * FROM country ORDER BY name ASC");
                  while ($a = mysqli_fetch_array($query)) { ?>
                    <option value="<?= $a['id'] ?>" <?php if ($row->country_code == $a['id']) {
                                                      echo "SELECTED";
                                                    } ?>><?= ucfirst(strtolower($a['name'])); ?> ( <?= $a['phonecode']; ?> )</option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="mobile_number">Mobile Number *</label>
                <input type="number" class="form-control" name="mobile_number" id="mobile_number" required="required" autocomplete="off" placeholder="Enter Mobile Number *" value="<?= $row->actual_number; ?>">
              </div>
              <div class="form-group">
                <label for="remarks">Remarks *</label>
                <textarea class="form-control" name="remarks" id="remarks" required="required" autocomplete="off" placeholder="Enter Remarks *"><?= $row->remarks; ?> </textarea>
              </div>
              <div class="form-group">
                <label for="remarks">Status </label>
                <select class="form-control" name="status" required="">
                  <option value="">Select Status </option>
                  <option <?php if ($row->status == 1) {
                            echo "SELECTED";
                          } ?> value="1">Active </option>
                  <option <?php if ($row->status == 0) {
                            echo "SELECTED";
                          } ?> value="0">Inactive </option>

                </select>
              </div>

              <button type="submit" class="btn btn-success" name="update_customer">UPDATE</button>
            </form>
          </div>
        </div>

      </div>
    </div><!-- content -->
  </div>
</div>
</div>
<!--footer-->
<?php include_once('footer.php'); ?>