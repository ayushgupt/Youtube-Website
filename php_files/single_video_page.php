<?php
session_start();
?>
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>  
<?php
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


<?php





$videoid=$_GET['videoid'];
$db = pg_connect("host=localhost port=5432 dbname=youtube_db user=postgres password=ayush");
$result= pg_query($db,"Select * from videoid_info WHERE videoid='$videoid'" );
$row = pg_fetch_assoc($result);
echo 
" 
<center>
<div class=\"jumbotron\">
<h1>
VIDEO WIKI PAGE
</h1>
<h3>  
 <br> 
 VideoTitle  : $row[videotitle]
 <br> 
 Uploaded on $row[publishedat]
 <br> 
 DefaultAudioLanguage is  $row[defaultaudiolanguage]
 <br> 
 Duration             is  $row[duration]
 <br> 
 Caption              is  $row[caption]
 <br> 
 Viewcount           : $row[viewcount]
 <br> 
 Likecount       :  $row[likecount]
 <br> 
 Dislikecount   :  $row[dislikecount]
 <br> 
 CommentCount        :  $row[commentcount]
 <br> 
 </h3>
 </div>
";
;

$result= pg_query($db,"Select * from channelid_channeltitle WHERE channelid='$row[channelid]'" );
$row1 = pg_fetch_assoc($result);
$sizeof_row1=sizeof($row1,1);
// echo"size of row 1 is $sizeof_row1 ";
if($sizeof_row1==2)
{
  echo
  "
  <div class=\"jumbotron\">
  <br>
  <h4>
  Channel Name is $row1[channeltitle]
  </h4>
  <br>
  </div>
  ";  
}
else
{
  echo
  "
  <br>
  Channel Name is not known
  <br>
  ";  
}



$result= pg_query($db,"Select * from playlistid_videoid WHERE videoid='$row[videoid]'" );
$row2 = pg_fetch_assoc($result);
$sizeof_row2=sizeof($row2,1);
if($sizeof_row2==2)
{
  $result= pg_query($db,"Select * from playlist_info WHERE playlistid='$row2[playlistid]'" );
  $row3 = pg_fetch_assoc($result);
  $sizeof_row3=sizeof($row3,1);
  if($sizeof_row3==4)
  {
    echo
    "
    <div class=\"jumbotron\">
  <br>
  <h4>
  PlaylistName : $row3[playlisttitle]
  </h4>
  <br>
  </div>
    <br>
    ";  
  }
  else
  {
    echo
    "
    <br>
    This video doesn't exist in any playlist
    <br>
    ";  
  }
}
else
{
  echo
  "
  <br>
  This video doesn't exist in any playlist
  <br>
  ";  
}


$result= pg_query($db,"Select * from email_videoid_comment WHERE videoid='$row[videoid]'" );
$result1= pg_query($db,"Select * from commentid_info WHERE videoid='$row[videoid]'" );
echo"
<table>
 <tr>
    <td>Email/ChannelName</td>
    <td>Comment</td>
 </tr>


";

while ($row_comment1 = pg_fetch_assoc($result1)) 
{
  $result2= pg_query($db,"Select * from channelid_channeltitle WHERE channelid='$row_comment1[channelid]'" );
  $row_comment2=pg_fetch_assoc($result2);
  echo
  "
   <tr>
      <td>$row_comment2[channeltitle]</td>
      <td>This text is on youtube. We didnt download the text.</td>
   </tr>
  ";
}


while ($row_comment = pg_fetch_assoc($result)) 
{
echo
"
 <tr>
    <td>$row_comment[email]</td>
    <td>$row_comment[comment]</td>
 </tr>
";
}
echo
"
</table>
";
?>

<?php  

if ($_SERVER["REQUEST_METHOD"] == "POST" and !empty($_SESSION["email"])) 
{  
  if($_POST[form_number]==1)
  {
      $db = pg_connect("host=localhost port=5432 dbname=youtube_db user=postgres password=ayush");
      $email_comment=$_SESSION["email"];
      $comment_text=$_POST["comment_text"];
      $result= pg_query($db,"INSERT INTO email_videoid_comment VALUES('$email_comment','$row[videoid]','$comment_text')" );
      $new_comment_count=($row[commentcount]+1);
      $result= pg_query($db,"UPDATE videoid_info SET commentcount='$new_comment_count' WHERE videoid='$row[videoid]'" );
      header("Location: http://localhost/single_video_page.php?videoid=".$videoid); /* Redirect browser */
          exit();
  }
  elseif ($_POST[form_number]==2) 
  {
    $db = pg_connect("host=localhost port=5432 dbname=youtube_db user=postgres password=ayush");
    $email_comment=$_SESSION["email"];
    $new_title=$_POST["new_video_title"];
    $result= pg_query($db,"UPDATE videoid_info SET videotitle='$new_title' WHERE videoid='$row[videoid]'" );
    header("Location: http://localhost/single_video_page.php?videoid=".$videoid); /* Redirect browser */
          exit();
  }
}

?>
<form method="post" action="single_video_page.php?videoid=<?php echo "$videoid"; ?>">
Comment: <input type="text" name="comment_text">
<input type="hidden" name="videoid" value="$videoid">
<input type="hidden" name="form_number" value="1">
<input type="submit" name="submit" value="Submit">
</form>
<?php 

if($_SESSION["permissions"]==1)
{
echo 
"
<form method=\"post\" action=\"single_video_page.php?videoid=$videoid\">
Update Video Title: <input type=\"text\" name=\"new_video_title\">
<input type=\"hidden\" name=\"videoid\" value=\"$videoid\">
<input type=\"hidden\" name=\"form_number\" value=\"2\">
<input type=\"submit\" name=\"submit\" value=\"Submit\">
</form>  

";
}

 ?>


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
