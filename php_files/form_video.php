<?php
session_start();
?>
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
<?php
// define variables and set to empty values
//commentvalues
$comment_lessthan_constraint=$comment_lessthan_number="";
$comment_greaterthan_constraint=$comment_greaterthan_number="";
$comment_equal_constraint=$comment_equal_number="";
//likecountvalues
$likecount_lessthan_constraint=$likecount_lessthan_number="";
$likecount_greaterthan_constraint=$likecount_greaterthan_number="";
$likecount_equal_constraint=$likecount_equal_number="";
//dislikecountvalues
$dislikecount_lessthan_constraint=$dislikecount_lessthan_number="";
$dislikecount_greaterthan_constraint=$dislikecount_greaterthan_number="";
$dislikecount_equal_constraint=$dislikecount_equal_number="";
//durationvalues
$duration_lessthan_constraint=$duration_lessthan_number="";
$duration_greaterthan_constraint=$duration_greaterthan_number="";
$duration_equal_constraint=$duration_equal_number="";
//viewcountvalues
$viewcount_lessthan_constraint=$viewcount_lessthan_number="";
$viewcount_greaterthan_constraint=$viewcount_greaterthan_number="";
$viewcount_equal_constraint=$viewcount_equal_number="";
//orderbyvalues
$orderby_number="";
$ascending_descending="";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  if($_POST[form_number]==19)
    {
        session_destroy ();
        header("Location: http://localhost/first_page.php"); /* Redirect browser */
            exit();
    }
}

?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <input type="submit" name="submit" value="Logout">  
  <input type="hidden" name="form_number" value="19">
</form>
<center>
<h2>Search Videos!!!</h2>
<form method="post" action="dynamic_query_video.php">


<div class="jumbotron">
  "Less Than" constraint of Comment:(Y or N)<input type="text" name="comment_lessthan_constraint" value="<?php echo $comment_lessthan_constraint;?>">
  <br>
  Less than value: <input type="number" name="comment_lessthan_number" value="<?php echo $comment_lessthan_number;?>">

  <br><br>

  "Greater than" constraint of Comment:(Y or N)<input type="text" name="comment_greaterthan_constraint" value="<?php echo $comment_greaterthan_constraint;?>">
  <br>
  Greater than value: <input type="number" name="comment_greaterthan_number" value="<?php echo $comment_greaterthan_number;?>">

  <br><br>

  "EQUAL" constraint of Comment:(Y or N)<input type="text" name="comment_equal_constraint" value="<?php echo $comment_equal_constraint;?>">
  <br>
  EQUAL value: <input type="number" name="comment_equal_number" value="<?php echo $comment_equal_number;?>">

</div>
  <br><br>

<div class="jumbotron">

  "Less Than" constraint of Like-Count:(Y or N)<input type="text" name="likecount_lessthan_constraint" value="<?php echo $likecount_lessthan_constraint;?>">
  <br>
  Less than value: <input type="number" name="likecount_lessthan_number" value="<?php echo $likecount_lessthan_number;?>">

  <br><br>

  "Greater than" constraint of Like-Count:(Y or N)<input type="text" name="likecount_greaterthan_constraint" value="<?php echo $likecount_greaterthan_constraint;?>">
  <br>
  Greater than value: <input type="number" name="likecount_greaterthan_number" value="<?php echo $likecount_greaterthan_number;?>">

  <br><br>

  "EQUAL" constraint of Like-Count:(Y or N)<input type="text" name="likecount_equal_constraint" value="<?php echo $likecount_equal_constraint;?>">
  <br>
  EQUAL value: <input type="number" name="likecount_equal_number" value="<?php echo $likecount_equal_number;?>">

</div>
  <br><br>

<div class="jumbotron">

  "Less Than" constraint of dislike-Count:(Y or N)<input type="text" name="dislikecount_lessthan_constraint" value="<?php echo $dislikecount_lessthan_constraint;?>">
  <br>
  Less than value: <input type="number" name="dislikecount_lessthan_number" value="<?php echo $dislikecount_lessthan_number;?>">

  <br><br>

  "Greater than" constraint of dislike-Count:(Y or N)<input type="text" name="dislikecount_greaterthan_constraint" value="<?php echo $dislikecount_greaterthan_constraint;?>">
  <br>
  Greater than value: <input type="number" name="dislikecount_greaterthan_number" value="<?php echo $dislikecount_greaterthan_number;?>">

  <br><br>

  "EQUAL" constraint of dislike-Count:(Y or N)<input type="text" name="dislikecount_equal_constraint" value="<?php echo $dislikecount_equal_constraint;?>">
  <br>
  EQUAL value: <input type="number" name="dislikecount_equal_number" value="<?php echo $dislikecount_equal_number;?>">

</div>
  <br><br>

<div class="jumbotron">

  "Less Than" constraint of DURATION:(Y or N)<input type="text" name="duration_lessthan_constraint" value="<?php echo $duration_lessthan_constraint;?>">
  <br>
  Less than value: <input type="number" name="duration_lessthan_number" value="<?php echo $duration_lessthan_number;?>">

  <br><br>

  "Greater than" constraint of DURATION:(Y or N)<input type="text" name="duration_greaterthan_constraint" value="<?php echo $duration_greaterthan_constraint;?>">
  <br>
  Greater than value: <input type="number" name="duration_greaterthan_number" value="<?php echo $duration_greaterthan_number;?>">

  <br><br>

  "EQUAL" constraint of DURATION:(Y or N)<input type="text" name="duration_equal_constraint" value="<?php echo $duration_equal_constraint;?>">
  <br>
  EQUAL value: <input type="number" name="duration_equal_number" value="<?php echo $duration_equal_number;?>">

</div>
  <br><br>

<div class="jumbotron">

  "Less Than" constraint of View-Count:(Y or N)<input type="text" name="viewcount_lessthan_constraint" value="<?php echo $viewcount_lessthan_constraint;?>">
  <br>
  Less than value: <input type="number" name="viewcount_lessthan_number" value="<?php echo $viewcount_lessthan_number;?>">

  <br><br>

  "Greater than" constraint of View-Count:(Y or N)<input type="text" name="viewcount_greaterthan_constraint" value="<?php echo $viewcount_greaterthan_constraint;?>">
  <br>
  Greater than value: <input type="number" name="viewcount_greaterthan_number" value="<?php echo $viewcount_greaterthan_number;?>">

  <br><br>

  "EQUAL" constraint of View-Count:(Y or N)<input type="text" name="viewcount_equal_constraint" value="<?php echo $viewcount_equal_constraint;?>">
  <br>
  EQUAL value: <input type="number" name="viewcount_equal_number" value="<?php echo $viewcount_equal_number;?>">

</div>
  <br><br>

<div class="jumbotron">


  Do you want to order by something:(Y or N)<input type="text" name="orderby_constraint" value="<?php echo $orderby_constraint;?>">
  <br>
  for viewcount enter 1:
  <br>
  for commentcount enter 2:
  <br>
  for duration enter 3:
  <br>
  for likecount enter 4:
  <br>
  for dislikecount enter 5:
  <input type="number" name="orderby_number" value="<?php echo $orderby_number;?>">
  <br>
  Descending(Type 1) or Ascending(Type 2):
  <input type="number" name="ascending_descending" value="<?php echo $ascending_descending;?>">

</div>
  <br><br>


  <input type="submit" name="submit" value="Submit">  
  </center>
</form>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>