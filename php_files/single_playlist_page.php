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





$playlistid=$_GET['playlistid'];
$db = pg_connect("host=localhost port=5432 dbname=youtube_db user=postgres password=ayush");
$result= pg_query($db,"Select * from playlist_info_channel WHERE playlistid='$playlistid'" );
$row = pg_fetch_assoc($result);
$playlisttitle=$row[playlisttitle];
$channeltitle=$row[channeltitle];
$playlistvideocount=$row[playlistvideocount];
$channelid=$row[channelid];
$playlist_found=0;
if(sizeof($row,1)>2)
{
  $playlist_found=1;
  echo 
  " 
  <center>
    <br>
    playlisttitle is $playlisttitle
    <br>
    channeltitle is $channeltitle
    <br>
    playlistvideocount is $playlistvideocount
    <br>
  </center>
  ";
}
else
{
  echo"<br>This playlist information is not in the database<br>";
}

echo"<br>Below is a list of Videos in the playlist with the latest Videos at the top<br>";
$result= pg_query($db,"select * from playlist_videos_info where playlistid='$playlistid' order by publishedat DESC" );
echo"
<table>
 <tr>
    <td>VideoTitle</td>
    <td>ViewCount</td>
    <td>VideoPage</td>
 </tr>


";

while ($row1 = pg_fetch_assoc($result)) 
{
echo
"
 <tr>
    <td>$row1[videotitle]</td>
    <td>$row1[viewcount]</td>
    <td><a href=\"single_video_page.php?videoid=$row1[videoid]\">MORE_INFO</a></td>
 </tr>
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
