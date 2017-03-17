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
//videocountvalues
$videocount_lessthan_constraint=$videocount_lessthan_number="";
$videocount_greaterthan_constraint=$videocount_greaterthan_number="";
$videocount_equal_constraint=$videocount_equal_number="";
//subscribercountvalues
$subscribercount_lessthan_constraint=$subscribercount_lessthan_number="";
$subscribercount_greaterthan_constraint=$subscribercount_greaterthan_number="";
$subscribercount_equal_constraint=$subscribercount_equal_number="";
//viewcountvalues
$viewcount_lessthan_constraint=$viewcount_lessthan_number="";
$viewcount_greaterthan_constraint=$viewcount_greaterthan_number="";
$viewcount_equal_constraint=$viewcount_equal_number="";
//orderbyvalues
$orderby_number="";
$ascending_descending="";
//countryvalues
$country_constraint="";
$country_value="";

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
<h2>Search Channels!!!</h2>
<form method="post" action="dynamic_query_channel.php">

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

  "Less Than" constraint of VideoCount:(Y or N)<input type="text" name="videocount_lessthan_constraint" value="<?php echo $videocount_lessthan_constraint;?>">
  <br>
  Less than value: <input type="number" name="videocount_lessthan_number" value="<?php echo $videocount_lessthan_number;?>">

  <br><br>

  "Greater than" constraint of VideoCount:(Y or N)<input type="text" name="videocount_greaterthan_constraint" value="<?php echo $videocount_greaterthan_constraint;?>">
  <br>
  Greater than value: <input type="number" name="videocount_greaterthan_number" value="<?php echo $videocount_greaterthan_number;?>">

  <br><br>

  "EQUAL" constraint of VideoCount:(Y or N)<input type="text" name="videocount_equal_constraint" value="<?php echo $videocount_equal_constraint;?>">
  <br>
  EQUAL value: <input type="number" name="videocount_equal_number" value="<?php echo $videocount_equal_number;?>">

</div>
  <br><br>

<div class="jumbotron">

  "Less Than" constraint of Subscriber-Count:(Y or N)<input type="text" name="subscribercount_lessthan_constraint" value="<?php echo $subscribercount_lessthan_constraint;?>">
  <br>
  Less than value: <input type="number" name="subscribercount_lessthan_number" value="<?php echo $subscribercount_lessthan_number;?>">

  <br><br>

  "Greater than" constraint of Subscriber-Count:(Y or N)<input type="text" name="subscribercount_greaterthan_constraint" value="<?php echo $subscribercount_greaterthan_constraint;?>">
  <br>
  Greater than value: <input type="number" name="subscribercount_greaterthan_number" value="<?php echo $subscribercount_greaterthan_number;?>">

  <br><br>

  "EQUAL" constraint of Subscriber-Count:(Y or N)<input type="text" name="subscribercount_equal_constraint" value="<?php echo $subscribercount_equal_constraint;?>">
  <br>
  EQUAL value: <input type="number" name="subscribercount_equal_number" value="<?php echo $subscribercount_equal_number;?>">

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

    "EQUAL" constraint of Country:(Y or N)<input type="text" name="country_constraint" value="<?php echo $country_constraint;?>">  
  <br>
  EQUAL value: <input type="text" name="country_value" value="<?php echo $country_value;?>">

  <br><br>
  
  Do you want to order by something:(Y or N)<input type="text" name="orderby_constraint" value="<?php echo $orderby_constraint;?>">
  <br>
  for viewcount enter 1:
  <br>
  for commentcount enter 2:
  <br>
  for videocount enter 3:
  <br>
  for subscribercount enter 4:
  <input type="number" name="orderby_number" value="<?php echo $orderby_number;?>">
  <br>
  Descending(Type 1) or Ascending(Type 2):
  <input type="number" name="ascending_descending" value="<?php echo $ascending_descending;?>">

</div>
  <br><br>

<div class="jumbotron">

  <input type="submit" name="submit" value="Submit">
  </div>
</form>
</center>
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