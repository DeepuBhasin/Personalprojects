<?php include_once('header.php');
$id = $_GET['id'];
$query = mysqli_query($con, "SELECT * FROM group_table where `id`=$id");
$row = mysqli_fetch_object($query);
?>
<div class="col-xs-12 col-sm-9 content">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="content-row">
                <?php include_once('message.php'); ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"><b>Edit Group</b>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="program_file.php" method="post">
                            <div class="form-group">
                                <label for="group_name">Group Name *</label>
                                <input type="hidden" name="group_id" value="<?= $row->id; ?>">
                                <input type="text" class="form-control" name="group_name" id="group_name" required="required" autocomplete="off" placeholder="Enter Group Name *" value="<?= $row->group_name; ?>">
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
                                <label for="group_number">Group Number *</label>
                                <input type="text" class="form-control" name="group_number" id="group_number" required="required" autocomplete="off" placeholder="Enter Group Number *" value="<?= $row->actual_number; ?>">
                            </div>


                            <div class="form-group">
                                <label for="remarks">Remarks </label>
                                <textarea class="form-control" name="remarks" id="remarks" autocomplete="off" placeholder="Enter Remarks "><?= $row->remarks ?></textarea>
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

                            <button type="submit" class="btn btn-success" name="update_group">Update</button>
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