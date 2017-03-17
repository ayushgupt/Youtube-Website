<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>REGISTER</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../../dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style type="text/css">
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

<body>

<?php
// define variables and set to empty values
$passwordErr = $emailErr =$permissionErr= "";
$password_value = $email =$permission= "";
$update_status="";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{  
  $getout=0;
  if (empty($_POST["email"])) 
  {
    $emailErr = "Email is required";
    $getout=1;
  } 
  else 
  {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $emailErr = "Invalid email format";
      $getout=1; 
    }
}
    
  if (empty($_POST["password_value"])) 
  {
    $passwordErr="Password is empty";
    $getout=1;
  }
  else
  {
    $password_value=$_POST["password_value"];
  }

  if (!empty($_POST["permission"]) && ($_POST["permission"]==0 || $_POST["permission"]==1) ) 
  {
    $permission=$_POST["permission"];
  }
  else
  {
    $permissionErr="Permissions is set wrong";
    $getout=1;
  }
  
  if($getout==0)
  {
    $db = pg_connect("host=localhost port=5432 dbname=youtube_db user=postgres password=ayush");
    $result= pg_query($db,"Select * from email_password WHERE email='$email'" );
    $row = pg_fetch_assoc($result);
    $sizeof_row=sizeof($row,1);
    if($sizeof_row==3)
    {
      $update_status="This email is already registered with us! Please dont try to make multiple accounts!";
    }
    else
    {
      $hashed_password=md5($password_value);
      $result= pg_query($db,"INSERT INTO email_password VALUES('$email','$hashed_password','$permission')" );
      $update_status="Thanks for registering : $email";
      $email="";
      $password_value="";
      $permission="";
    }
  }


}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<center>
<form method="post" action="first_page.php">  
  <input type="submit" name="submit" value="Back to MainPage">
</form>
<div class="jumbotron">
<h2>Register for this Awesome Database</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Password: <input type="password" name="password_value" value="<?php echo $password_value;?>">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  Permissions (0 for normal,1 for moderator): <input type="int" name="permission" value="<?php echo $permission;?>">
  <span class="error">* <?php echo $permissionErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo
"
$update_status
";
?>
</div>
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