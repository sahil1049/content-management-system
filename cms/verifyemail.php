<?php
include("server.php");
session_destroy();

if(!isset($_GET["verify"])){
    include_once("verifyemail.php");
    exit("Cant find page");
}
$verify= $_GET["verify"];

$getQuery = mysqli_query($db, "SELECT email FROM emailverify WHERE verify='$verify'");
if(mysqli_num_rows($getQuery)==0){
    exit("Cant find page");}
if(mysqli_num_rows($getQuery)!=0){
$row= mysqli_fetch_array($getQuery);
$email=$row["email"];

mysqli_query($db, "UPDATE users SET status='1' WHERE email='$email'");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>CMS</title>
  
    <SCRIPT type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</SCRIPT>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->

   <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.3/css/mdb.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body onload="noBack();" 
	onpageshow="if (event.persisted) noBack();" onunload="">
<nav style="background-color:rgb(43, 94, 128)" class="mb-4 navbar navbar-expand-lg navbar-dark ">
                <a  class="navbar-brand " href="index.php">Navonsoft CMS</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                    <ul class="navbar-nav ml-auto">
                        
                      
                        <li class="nav-item ">
                            <a style="color:white"href="./login.php"  aria-haspopup="true" aria-expanded="false"><h5>Login</h5> </a>
                          
                        </li>
                    </ul>
                </div>
            </nav>
        
        <div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h2 style="text-align:center">Voila!!</h2>
        <h1 style="text-align:center">User Activated</h1>
        </div>
</body>
</html>