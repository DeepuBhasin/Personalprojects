<?php
session_start();

try {

	$dbhost=$_SESSION['dbhost'];
	$dbusr=$_SESSION['dbusr'];
	$dbpwd=$_SESSION['dbpwd'];
	$dbname=$_SESSION['dbname'];
	$table_name=$_SESSION['table_name'];


    $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $ex) {
    echo 'Connection failed: ' . $ex->getMessage();
}

$question_count=count($_POST['question_id']);
$quizCheck=array_values($_POST['quizCheck']);

$score=0;
$total_attepmt=0;
$total_incorrect=0;
$count=1;



for($i=0;$i<$question_count;$i++)
{
	$question_id=$_POST['question_id'][$i];

	$result = $db->prepare("SELECT * FROM $table_name WHERE question_id=:question_id"); // 
	$result->execute(['question_id'=>$question_id]);
	$result=$result->fetch(PDO::FETCH_OBJ);

	echo "<pre>";
	echo "$count Question : ".$result->question."<br/>";
	

	if($quizCheck[$i]!="0")
	{
		if($result->correct_answer==$quizCheck[$i])
		{
			echo "  Status : Your Answer is Correct <br/>";
			$score++;
		}
		else
		{
			echo "  Status : Your Answer is Wrong <br/>";
		}	
		$total_attepmt++;

		$submitted=$quizCheck[$i];
	}
	else
	{
		echo "  Status : Not Answered <br/>";
		$submitted="";
	}

	echo "  Submitted Answer : $submitted <br/>";
	echo "  Correct Answer : ".$result->correct_answer."<br/>";	

	echo "</pre>";	
	$count++;
}	

$total_incorrect=$total_attepmt-$score;
$not_attempt=$question_count-$total_attepmt;

score_board($question_count,$total_attepmt,$not_attempt,$score,$total_incorrect);

function score_board($question_count,$total_attepmt,$not_attempt,$total_correct,$total_incorrect)
{
	echo "<table border='2' cellpadding='5' cellspacing='6'>";
	echo "<tr>";
	echo "<th colspan='2'>Score Board</th>";
	echo "</tr><tr>";
	echo "<td>Total Questions</td><td>$question_count</td>";
	echo "</tr><tr>";
	echo "<td>Total Attempt</td><td>$total_attepmt</td>";
	echo "</tr><tr>";
	echo "<td>Total Not Attempt</td><td>$not_attempt</td>";
	echo "</tr><tr>";
	echo "<td>Total Correct</td><td>$total_correct</td>";
	echo "</tr><tr>";
	echo "<td>Total Incorrect</td><td>$total_incorrect</td>";
	echo "</tr><tr>";
	echo "<td><b>Your Score </b></td><td><b>$total_correct</b></td>";
	echo "</tr>";
	echo "</table>";

}

?>

<h3><a href="index.php">Home Page</a></h3>
