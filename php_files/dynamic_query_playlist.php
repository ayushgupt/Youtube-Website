<?php
$self_php=$_SERVER["PHP_SELF"];
session_start();
?>
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



echo "<!DOCTYPE html>
<html>
<head>
<style>
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
input[type=button], input[type=submit], input[type=reset] 
    {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
    }
</style>
<br>
<body>
<form method=\"post\" action=\"$self_php\">  
  <input type=\"submit\" name=\"submit\" value=\"Logout\">  
  <input type=\"hidden\" name=\"form_number\" value=\"19\">
</form>
<center>
<h1>Playlist Results</h1>
</center>

";



$db = pg_connect("host=localhost port=5432 dbname=youtube_db user=postgres password=ayush");

$videocount_lessthan_constraint=$_POST['videocount_lessthan_constraint'];
$videocount_lessthan_number=$_POST['videocount_lessthan_number'];

$videocount_greaterthan_constraint=$_POST['videocount_greaterthan_constraint'];
$videocount_greaterthan_number=$_POST['videocount_greaterthan_number'];

$videocount_equal_constraint=$_POST['videocount_equal_constraint'];
$videocount_equal_number=$_POST['videocount_equal_number'];


$playlisttitle_constraint=$_POST['playlisttitle_constraint'];
$playlisttitle_value=$_POST['playlisttitle_value'];



$start_query="SELECT * FROM playlist_info WHERE playlistvideocount>=0 ";
$videocount_lessthan_query="";
if(strcmp($videocount_lessthan_constraint, "Y")==0)
{
    $videocount_lessthan_query=" AND playlistvideocount<$videocount_lessthan_number ";
}

$videocount_greaterthan_query="";
if(strcmp($videocount_greaterthan_constraint, "Y")==0)
{
    $videocount_greaterthan_query=" AND playlistvideocount>$videocount_greaterthan_number ";
}

$videocount_equal_query="";
if(strcmp($videocount_equal_constraint, "Y")==0)
{
    $videocount_equal_query=" AND playlistvideocount=$videocount_equal_number ";
}

$playlisttitle_query=" ";
if(strcmp($playlisttitle_constraint, "Y")==0)
{
    $playlisttitle_query=" AND playlisttitle='$playlisttitle_value' ";
}


$order_query=" ORDER BY playlistvideocount DESC";


$final_query=$start_query.$videocount_lessthan_query.$videocount_greaterthan_query.$videocount_equal_query.$playlisttitle_query.$order_query;


$result= pg_query($db,$final_query );

// $result = pg_query($db, 
//     "SELECT videoid,videotitle,viewcount 
//     FROM videoid_info 
//     WHERE viewcount<$random_value 
//     AND viewcount>$random_value2
//     ORDER BY viewcount DESC" );

echo"
<table>
 <tr>
    <td>PlaylistTitle</td>
    <td>Videocount</td>
    <td>PlaylistPage</td>
 </tr>


";
while ($row = pg_fetch_assoc($result)) 
{
echo
"
 <tr>
    <td>$row[playlisttitle]</td>
    <td>$row[playlistvideocount]</td>
    <td><a href=\"single_playlist_page.php?playlistid=$row[playlistid]\" target=\"_blank\">MORE_INFO</a></td>
 </tr>
";
}
echo
"
</table>
</body>
</html>
";
?>