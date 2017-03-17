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
<h1>Channel Results</h1>
</center>
";







$db = pg_connect("host=localhost port=5432 dbname=youtube_db user=postgres password=ayush");

$comment_lessthan_constraint=$_POST['comment_lessthan_constraint'];
$comment_lessthan_number=$_POST['comment_lessthan_number'];

$comment_greaterthan_constraint=$_POST['comment_greaterthan_constraint'];
$comment_greaterthan_number=$_POST['comment_greaterthan_number'];

$comment_equal_constraint=$_POST['comment_equal_constraint'];
$comment_equal_number=$_POST['comment_equal_number'];

$videocount_lessthan_constraint=$_POST['videocount_lessthan_constraint'];
$videocount_lessthan_number=$_POST['videocount_lessthan_number'];

$videocount_greaterthan_constraint=$_POST['videocount_greaterthan_constraint'];
$videocount_greaterthan_number=$_POST['videocount_greaterthan_number'];

$videocount_equal_constraint=$_POST['videocount_equal_constraint'];
$videocount_equal_number=$_POST['videocount_equal_number'];

$subscribercount_lessthan_constraint=$_POST['subscribercount_lessthan_constraint'];
$subscribercount_lessthan_number=$_POST['subscribercount_lessthan_number'];

$subscribercount_greaterthan_constraint=$_POST['subscribercount_greaterthan_constraint'];
$subscribercount_greaterthan_number=$_POST['subscribercount_greaterthan_number'];

$subscribercount_equal_constraint=$_POST['subscribercount_equal_constraint'];
$subscribercount_equal_number=$_POST['subscribercount_equal_number'];

$viewcount_lessthan_constraint=$_POST['viewcount_lessthan_constraint'];
$viewcount_lessthan_number=$_POST['viewcount_lessthan_number'];

$viewcount_greaterthan_constraint=$_POST['viewcount_greaterthan_constraint'];
$viewcount_greaterthan_number=$_POST['viewcount_greaterthan_number'];

$viewcount_equal_constraint=$_POST['viewcount_equal_constraint'];
$viewcount_equal_number=$_POST['viewcount_equal_number'];

$country_constraint=$_POST['country_constraint'];
$country_value=$_POST['country_value'];


// $random_value=7000;
// $random_value2=6500;
// $viewcount_lessthan_constraint="Y";
// $viewcount_lessthan_number=6000;

$start_query="SELECT * FROM channelid_info WHERE viewcount>=0 ";
$viewcount_lessthan_query="";
if(strcmp($viewcount_lessthan_constraint, "Y")==0)
{
    $viewcount_lessthan_query=" AND viewcount<$viewcount_lessthan_number ";
}

$viewcount_greaterthan_query="";
if(strcmp($viewcount_greaterthan_constraint, "Y")==0)
{
    $viewcount_greaterthan_query=" AND viewcount>$viewcount_greaterthan_number ";
}

$viewcount_equal_query="";
if(strcmp($viewcount_equal_constraint, "Y")==0)
{
    $viewcount_equal_query=" AND viewcount=$viewcount_equal_number ";
}

$subscribercount_lessthan_query="";
if(strcmp($subscribercount_lessthan_constraint, "Y")==0)
{
    $subscribercount_lessthan_query=" AND subscribercount<$subscribercount_lessthan_number ";
}

$subscribercount_greaterthan_query="";
if(strcmp($subscribercount_greaterthan_constraint, "Y")==0)
{
    $subscribercount_greaterthan_query=" AND subscribercount>$subscribercount_greaterthan_number ";
}

$subscribercount_equal_query="";
if(strcmp($subscribercount_equal_constraint, "Y")==0)
{
    $subscribercount_equal_query=" AND subscribercount=$subscribercount_equal_number ";
}

$videocount_lessthan_query="";
if(strcmp($videocount_lessthan_constraint, "Y")==0)
{
    $videocount_lessthan_query=" AND videocount<$videocount_lessthan_number ";
}

$videocount_greaterthan_query="";
if(strcmp($videocount_greaterthan_constraint, "Y")==0)
{
    $videocount_greaterthan_query=" AND videocount>$videocount_greaterthan_number ";
}

$videocount_equal_query="";
if(strcmp($videocount_equal_constraint, "Y")==0)
{
    $videocount_equal_query=" AND videocount=$videocount_equal_number ";
}


$comment_lessthan_query="";
if(strcmp($comment_lessthan_constraint, "Y")==0)
{
    $comment_lessthan_query=" AND commentcount<$comment_lessthan_number ";
}

$comment_greaterthan_query="";
if(strcmp($comment_greaterthan_constraint, "Y")==0)
{
    $comment_greaterthan_query=" AND commentcount>$comment_greaterthan_number ";
}

$comment_equal_query="";
if(strcmp($comment_equal_constraint, "Y")==0)
{
    $comment_equal_query=" AND commentcount=$comment_equal_number ";
}

$country_query=" ";
if(strcmp($country_constraint, "Y")==0)
{
    $country_query=" AND country='$country_value' ";
}


$order_query=" ORDER BY viewcount DESC";
$orderby_number=$_POST['orderby_number'];
$orderby_constraint=$_POST['orderby_constraint'];
$ascending_descending=$_POST['ascending_descending'];
if(strcmp($orderby_constraint, "Y")==0)
{
    if($orderby_number==1)
    {
        $order_query=" ORDER BY viewcount";
    }
    elseif ($orderby_number==2) 
    {
        $order_query=" ORDER BY commentcount";
    }
    elseif ($orderby_number==3) 
    {
        $order_query=" ORDER BY videocount";
    }
    elseif ($orderby_number==4) 
    {
        $order_query=" ORDER BY subscribercount";
    }

    if($ascending_descending==1)
    {
        $order_query=$order_query." DESC ";
    }
    elseif ($ascending_descending==2) 
    {
        $order_query=$order_query." ";
    }
}


$final_query=$start_query.$viewcount_lessthan_query.$viewcount_greaterthan_query.$viewcount_equal_query.$duration_lessthan_query.$duration_greaterthan_query.$duration_equal_query.$subscribercount_lessthan_query.$subscribercount_greaterthan_query.$subscribercount_equal_query.$videocount_lessthan_query.$videocount_greaterthan_query.$videocount_equal_query.$comment_lessthan_query.$comment_greaterthan_query.$comment_equal_query.$country_query.$order_query;


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
    <td>ChannelTitle</td>
    <td>ViewCount</td>
    <td>VideoPage</td>
 </tr>


";
while ($row = pg_fetch_assoc($result)) 
{
$result_channeltitle= pg_query($db,"Select * from channelid_channeltitle WHERE channelid='$row[channelid]'" );
$row_channeltitle=pg_fetch_assoc($result_channeltitle);
echo
"
 <tr>
    <td>$row_channeltitle[channeltitle]</td>
    <td>$row[viewcount]</td>
    <td><a href=\"single_channel_page.php?channelid=$row[channelid]\" target=\"_blank\">MORE_INFO</a></td>
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