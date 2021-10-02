<?php
include_once('header.php');
require_once('flowApi/vendor/autoload.php');

#Import Message controller and model
use FlowrouteMessagingLib\Controllers\MessagesController;
use FlowrouteMessagingLib\Models\Message;

if (isset($_POST['send_sms'])) {

    $group_id = $_POST['group_id'];
    $page_type = $_POST['page_type'];
    $sqlGroup = "SELECT mobile_number From group_table WHERE id='$group_id'";
    $row = mysqli_query($con, $sqlGroup);
    $fromNumber = mysqli_fetch_all($row)[0][0];
    $from_number =  $fromNumber;

    $sqlGroup = "SELECT mobile_number,media_option From user WHERE group_id='$group_id' and status=1 order by full_name ASC";
    $row = mysqli_query($con, $sqlGroup);
    $row = mysqli_fetch_all($row);

    $listArray = [];

    $controller = new MessagesController('ed7c15bd', 'dfe1092a7ba34a8d81629fd6f4d2c704');

    $messagebody = mysqli_real_escape_string($con, htmlentities(trim($_POST['message'])));

    $sql_truncate = "TRUNCATE TABLE voice_call";
    mysqli_query($con, $sql_truncate);

    foreach ($row as $key => $value) {

        if ($value[1] == 'voice') {

            $to_number = $value[0];

            $sql_insert = "INSERT into voice_call values(null,'+$from_number','+$to_number');";

            mysqli_query($con, $sql_insert);

            $listArray[] = [$value[0], $from_number, 'Voice Execute'];

            $setShellScript = true;
        } else if ($value[1] == 'sms' ||  $value[1] == 'both') {

            $message = new Message($value[0], $from_number, $messagebody);

            $to_number = $value[0];

            #Print the response
            $response = $controller->createMessage($message);

            if (!isset($response->errors)) {

                $mdr_id = strval($response->data->id);

                $mdr_record = $controller->getMessageLookup($mdr_id); // 'mdr1-b334f89df8de4f8fa7ce377e06090a2e'

                if ($mdr_record->code == 404) {
                    $succesMessgae = 'success with 404';
                } else {
                    $attributes = $mdr_record->body->data->attributes;
                    $succesMessgae = 'success with 200';
                }
                $succesMessgaeStatus = true;
            }

            $insertArray = [
                $page_type,
                isset($attributes->amount_display) ? $attributes->amount_display : 0,
                $messagebody,
                isset($attributes->direction) ? $attributes->direction : 'NA',
                $from_number,
                isset($attributes->message_type) ? $attributes->message_type : 'NA',
                isset($attributes->timestamp) ? $attributes->timestamp : 'NA',
                $to_number,
                isset($mdr_record->data->id) ? $mdr_record->body->data->id : 'NA',
                isset($mdr_record->data->type) ? $mdr_record->body->data->type : 'NA',
                isset($succesMessgaeStatus) ? $succesMessgae : 'fail',
                $_SESSION['id'],
                $get_time

            ];

            $listArray[] = [$insertArray[7], $insertArray[4], $insertArray[10]];

            $sqlMessage = "INSERT into sms_history values (null,'{$insertArray[0]}','{$insertArray[1]}','{$insertArray[2]}','{$insertArray[3]}','{$insertArray[4]}','{$insertArray[5]}','{$insertArray[6]}','{$insertArray[7]}','{$insertArray[8]}','{$insertArray[9]}','{$insertArray[10]}','{$insertArray[11]}','{$insertArray[12]}');";
            mysqli_query($con, $sqlMessage);

            if ($value[1] == 'both') {

                $to_number = $value[0];

                $sql_insert = "INSERT into voice_call values(null,'+$from_number','+$to_number');";

                mysqli_query($con, $sql_insert);

                $listArray[] = [$value[0], $from_number, 'Voice Execute'];

                $setShellScript = true;
            }
        }
    }

    if (isset($setShellScript)) {
        shell_exec('myscript.sh');
    }

    $MessageSent = true;
}
?>
<div class="col-xs-12 col-sm-9 content">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="content-row">
                <?php include_once('message.php');

                if (isset($MessageSent)) { ?>
                    <div class="alert alert-success">
                        <strong>Program Executed Successfully</strong>
                    </div>
                <?php
                    echo "<table style='width:50%; text-align:center;' border='1'><tr><td>Sro no<td>Mobile Number</td><td>From Number</td><td>Status</td></tr>";
                    $c = 0;
                    foreach ($listArray as $key => $value) {
                        echo "<tr><td>" . ++$c . "</td><td>+{$value[0]}</td><td>+{$value[1]}</td><td>{$value[2]}</td></tr>";
                    }
                    echo "</table><br/>";
                }
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"><b>Send SMS To Group </b>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="hidden" name="page_type" value="send group sms">
                            <div class="form-group">
                                <label for="group_id">Select Group *</label>
                                <select class="form-control" name="group_id" required="" id="group_id">
                                    <option value="">Select Group </option>
                                    <?php
                                    $query = mysqli_query($con, "SELECT id,group_name,mobile_number FROM group_table where status=1 order by group_name ASC");
                                    while ($a = mysqli_fetch_array($query)) { ?>
                                        <option value="<?= $a['id'] ?>"><?= ucfirst($a['group_name']); ?> ( +<?= ucfirst($a['mobile_number']); ?> )</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message">Enter Message *</label>
                                <textarea id="message" name="message" placeholder="Enter Message" required="" class="form-control"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success" name="send_sms">Send</button> <button type="reset" class="btn btn-info">Reset</button>
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