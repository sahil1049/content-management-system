<?php 
include('server.php');
?>
<!DOCTYPE html>
<html>
<head>
                    <meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CMS</title>
  <link rel="stylesheet" type="text/css" href="register.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script>
  			function myFunction() {
  var x = document.getElementById("pass");
  var y = document.getElementById("pass1");
  if ((x.type === "password")||(y.type==="password")) {
    x.type = "text";
    y.type = "text";
  } else {
    x.type = "password";
    y.type = "password";
  }
}
  </script>
</head>
<body>
  <div class="wrapper">
						<div class="container">
							<h1>Welcome !!</h1>
							<?php include('errors.php'); ?>
							<form class="form" method="post" action="register.php">
								<input type="text" name="username"  placeholder="Username" required value="<?php echo $username; ?>" >
								<input type="email" name="email"  placeholder="Email" required value="<?php echo $email; ?>" >
								<input type="password" id="pass"name="password_1" required placeholder="Password">
								<input type="password" id="pass1" name="password_2" required placeholder="Confirm Password">
								<i onclick="myFunction()"class="fa fa-eye"></i><br><br>
								<button type="submit"  name="reg_user" id="login-button">Sign Up</button>
							<br><br>
							<p>
							  Already a member? <a style="color:white"href="login.php">Sign in</a>
  	                        

  	                         
                                <a style="color:white"href="index.php">Home</a>
  	                     
  	                     </p>
							</form>
						
	
						</div>
						
						<ul class="bg-bubbles">
							<li></li>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
						</ul>
					</div>
</body>
</html>