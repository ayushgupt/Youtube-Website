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
//videocountvalues
$videocount_lessthan_constraint=$videocount_lessthan_number="";
$videocount_greaterthan_constraint=$videocount_greaterthan_number="";
$videocount_equal_constraint=$videocount_equal_number="";
//playlisttitlevalues
$playlisttitle_constraint="";
$playlisttitle_value="";

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
<div class="jumbotron">
<h2>Search Channels!!!</h2>
<form method="post" action="dynamic_query_playlist.php">


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
    "EQUAL" constraint of Playlist Title:(Y or N)<input type="text" name="playlisttitle_constraint" value="<?php echo $playlisttitle_constraint;?>">  
  <br>
  EQUAL value: <input type="text" name="playlisttitle_value" value="<?php echo $playlisttitle_value;?>">

</div>
  <br><br>

  <input type="submit" name="submit" value="Submit">  
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
