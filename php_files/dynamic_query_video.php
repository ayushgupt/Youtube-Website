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
<h1>Video Results</h1>
</center>

";


$db = pg_connect("host=localhost port=5432 dbname=youtube_db user=postgres password=ayush");

$comment_lessthan_constraint=$_POST['comment_lessthan_constraint'];
$comment_lessthan_number=$_POST['comment_lessthan_number'];

$comment_greaterthan_constraint=$_POST['comment_greaterthan_constraint'];
$comment_greaterthan_number=$_POST['comment_greaterthan_number'];

$comment_equal_constraint=$_POST['comment_equal_constraint'];
$comment_equal_number=$_POST['comment_equal_number'];

$likecount_lessthan_constraint=$_POST['likecount_lessthan_constraint'];
$likecount_lessthan_number=$_POST['likecount_lessthan_number'];

$likecount_greaterthan_constraint=$_POST['likecount_greaterthan_constraint'];
$likecount_greaterthan_number=$_POST['likecount_greaterthan_number'];

$likecount_equal_constraint=$_POST['likecount_equal_constraint'];
$likecount_equal_number=$_POST['likecount_equal_number'];

$dislikecount_lessthan_constraint=$_POST['dislikecount_lessthan_constraint'];
$dislikecount_lessthan_number=$_POST['dislikecount_lessthan_number'];

$dislikecount_greaterthan_constraint=$_POST['dislikecount_greaterthan_constraint'];
$dislikecount_greaterthan_number=$_POST['dislikecount_greaterthan_number'];

$dislikecount_equal_constraint=$_POST['dislikecount_equal_constraint'];
$dislikecount_equal_number=$_POST['dislikecount_equal_number'];

$duration_lessthan_constraint=$_POST['duration_lessthan_constraint'];
$duration_lessthan_number=$_POST['duration_lessthan_number'];

$duration_greaterthan_constraint=$_POST['duration_greaterthan_constraint'];
$duration_greaterthan_number=$_POST['duration_greaterthan_number'];

$duration_equal_constraint=$_POST['duration_equal_constraint'];
$duration_equal_number=$_POST['duration_equal_number'];

$viewcount_lessthan_constraint=$_POST['viewcount_lessthan_constraint'];
$viewcount_lessthan_number=$_POST['viewcount_lessthan_number'];

$viewcount_greaterthan_constraint=$_POST['viewcount_greaterthan_constraint'];
$viewcount_greaterthan_number=$_POST['viewcount_greaterthan_number'];

$viewcount_equal_constraint=$_POST['viewcount_equal_constraint'];
$viewcount_equal_number=$_POST['viewcount_equal_number'];



// $random_value=7000;
// $random_value2=6500;
// $viewcount_lessthan_constraint="Y";
// $viewcount_lessthan_number=6000;

$start_query="SELECT videoid,videotitle,viewcount FROM videoid_info WHERE viewcount>=0 ";
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

$duration_lessthan_query="";
if(strcmp($duration_lessthan_constraint, "Y")==0)
{
    $duration_lessthan_query=" AND duration<$duration_lessthan_number ";
}

$duration_greaterthan_query="";
if(strcmp($duration_greaterthan_constraint, "Y")==0)
{
    $duration_greaterthan_query=" AND duration>$duration_greaterthan_number ";
}

$duration_equal_query="";
if(strcmp($duration_equal_constraint, "Y")==0)
{
    $duration_equal_query=" AND duration=$duration_equal_number ";
}


$dislikecount_lessthan_query="";
if(strcmp($dislikecount_lessthan_constraint, "Y")==0)
{
    $dislikecount_lessthan_query=" AND dislikecount<$dislikecount_lessthan_number ";
}

$dislikecount_greaterthan_query="";
if(strcmp($dislikecount_greaterthan_constraint, "Y")==0)
{
    $dislikecount_greaterthan_query=" AND dislikecount>$dislikecount_greaterthan_number ";
}

$dislikecount_equal_query="";
if(strcmp($dislikecount_equal_constraint, "Y")==0)
{
    $dislikecount_equal_query=" AND dislikecount=$dislikecount_equal_number ";
}

$likecount_lessthan_query="";
if(strcmp($likecount_lessthan_constraint, "Y")==0)
{
    $likecount_lessthan_query=" AND likecount<$likecount_lessthan_number ";
}

$likecount_greaterthan_query="";
if(strcmp($likecount_greaterthan_constraint, "Y")==0)
{
    $likecount_greaterthan_query=" AND likecount>$likecount_greaterthan_number ";
}

$likecount_equal_query="";
if(strcmp($likecount_equal_constraint, "Y")==0)
{
    $likecount_equal_query=" AND likecount=$likecount_equal_number ";
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
        $order_query=" ORDER BY duration";
    }
    elseif ($orderby_number==4) 
    {
        $order_query=" ORDER BY likecount";
    }
    elseif ($orderby_number==5) 
    {
        $order_query=" ORDER BY dislikecount";
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


$final_query=$start_query.$viewcount_lessthan_query.$viewcount_greaterthan_query.$viewcount_equal_query.$duration_lessthan_query.$duration_greaterthan_query.$duration_equal_query.$dislikecount_lessthan_query.$dislikecount_greaterthan_query.$dislikecount_equal_query.$likecount_lessthan_query.$likecount_greaterthan_query.$likecount_equal_query.$comment_lessthan_query.$comment_greaterthan_query.$comment_equal_query.$order_query;

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
    <td>VideoTitle</td>
    <td>ViewCount</td>
    <td>VideoPage</td>
 </tr>


";
while ($row = pg_fetch_assoc($result)) 
{
echo
"
 <tr>
    <td>$row[videotitle]</td>
    <td>$row[viewcount]</td>
    <td><a href=\"single_video_page.php?videoid=$row[videoid]\" target=\"_blank\">MORE_INFO</a></td>
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