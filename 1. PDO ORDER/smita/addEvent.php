<?php
session_start();
require_once './Classes/Database.php';
require_once './Classes/AddEvent.php';


if(isset($_POST["submit"])){

	$user_id	= $_POST['user_id']; 
    $event_date	= $_POST['event_date']; 
    $event_name	= $_POST['event_name']; 
    

	$result = $addEvent->createEvent($user_id,$event_date,$event_name);
	$message = $result['msg'];

	echo "<script> alert('$message'); </script> ";

}
?>

<?php require_once './sidebar.php';?>
<h1 id='mainhead'>We make your dream day come true.</h1>

<br><br>
<h2>What is the celebration for? </h2>
<form action="<?= $_SERVER['PHP_SELF'];?>" method="POST">

	<input type="hidden" name="user_id" value="<?= $_SESSION['actor']['id'];?>">
	
	<label for="event_date">Lets save the date </label>
	<input type="date" name="event_date" /> <br> 

	<label for="wedding">Wedding</label>
	<input type="radio" id="wedding" name="event_name" value="wedding" /><br>

	<label for="birthday_party">Birthday Bash</label>
	<input type="radio" id="birthday" name="event_name" value="Birthday" /><br>

	<label for="engagement">Ring Ceremony</label>
	<input type="radio" id="engagement" name="event_name" value="Engagement" /><br>

	<label for="office">Corporate Events</label>
	<input type="radio" id="office" name="event_name" value="Corporate events" /><br>

	<label for="baby_shower">Baby Shower</label>
	<input type="radio" id="baby_shower" name="event_name" value="Baby Shower" /><br>

	<input type="submit" name="submit" />
</form>