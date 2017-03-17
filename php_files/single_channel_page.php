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





$channelid=$_GET['channelid'];
$db = pg_connect("host=localhost port=5432 dbname=youtube_db user=postgres password=ayush");
$result= pg_query($db,"Select * from channelid_info where channelid='$channelid'" );
$row = pg_fetch_assoc($result);
$publishedat=$row[publishedat];
$country=$row[country];
$subscribercount=$row[subscribercount];
$videocount=$row[videocount];
$viewcount=$row[viewcount];
$commentcount=$row[commentcount];
$channel_found=0;
// channelid         |     publishedat     |  country   | subscribercount | videocount |  viewcount  | commentcount 
if(sizeof($row,1)>2)
{
  $channel_found=1;
  echo 
  " 
  <div class=\"jumbotron\">
  <br>
  <h4>
  <center>
    <br>
    publishedat is $publishedat
    <br>
    country is $country
    <br>
    subscribercount is $subscribercount
    <br>
    videocount is $videocount
    <br>
    viewcount is $viewcount
    <br>
    commentcount is $commentcount
    <br>
    </center>
  </h4>
  <br>
  </div>
    <br>


  ";
}
else
{
  echo"<br>This Channel is not in the database<br>";
}


$result= pg_query($db,"Select * from channelid_channeltitle where channelid='$channelid'" );
$row1 = pg_fetch_assoc($result);
$channeltitle=$row1[channeltitle];
if(sizeof($row1,2)==2)
{
    echo "<br>Channel Title is $channeltitle<br>";
}
else
{
    echo "<br>Wasn't Able to Find the Channel Name in Database<br>";
}






echo"<br>Below is a list of playlists in the channel with the More Video Containg Playlists at the top<br>";
$result= pg_query($db,"select * from playlist_info_channel where channelid='$channelid' order by  playlistvideocount DESC" );
echo"
<table>
 <tr>
    <td>PlaylistTitle</td>
    <td>ViewCount</td>
    <td>PlaylistPage</td>
 </tr>


";

while ($row2 = pg_fetch_assoc($result)) 
{
echo
"
 <tr>
    <td>$row2[playlisttitle]</td>
    <td>$row2[playlistvideocount]</td>
    <td><a href=\"single_playlist_page.php?playlistid=$row2[playlistid]\">MORE_INFO</a></td>
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
