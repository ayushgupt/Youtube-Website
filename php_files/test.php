<?php

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
</style>
<br>";


$db = pg_connect("host=localhost port=5432 dbname=basketball user=postgres password=ayush");
$result = pg_query($db, "SELECT * FROM basketball_abbrev ");
echo"
<table>
 <tr>
    <td>ID</td>
    <td>ABBREV_TYPE</td>
    <td>CODE</td>
    <td>FULL_NAME</td>
 </tr>


";
while ($row = pg_fetch_assoc($result)) 
{
echo
"
 <tr>
    <td>$row[id]</td>
    <td>$row[abbrev_type]</td>
    <td>$row[code]</td>
    <td>$row[full_name]</td>
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