<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  
  $verify= uniqid(true);
  $status=0;
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  

    
     if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database

    $query = "INSERT INTO users (username, email, password, status) 
          VALUES('$username', '$email', '$password', '$status')";
    
    mysqli_query($db, $query);
    $qurey2 =mysqli_query($db, "INSERT INTO emailverify (email, verify) VALUES('$email','$verify')");
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    echo("<script type='text/javascript'>alert('A link has been sent to your registered email id for the activation');
    window.location.href='login.php';
    </script>");

    $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/verifyemail.php?verify=$verify";

$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "email id",
                'Name' => "no reply"
            ],
            'To' => [
                [
                    'Email' => "$email",
                    'Name' => ""
                ]
            ],
            'Subject' => "Activation link.",
            'HTMLPart' => "<h3>Click this link to activate your account </h3><br />$url"
        ]
    ]
];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json')
);

curl_setopt($ch, CURLOPT_USERPWD, "public api:private api");
$server_output = curl_exec($ch);
curl_close ($ch);

$response = json_decode($server_output);
if ($response->Messages[0]->Status == 'success') {

}


}
}
// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    $query = mysqli_query($db, "SELECT * FROM users where username='$username' AND status='1'");

    if (mysqli_num_rows($query) == 0) {
        array_push($errors, "No such user exists, please sign up");
    }

    $query3 = mysqli_query($db, "SELECT * FROM users WHERE username='$username' AND status='1'");

    if (mysqli_num_rows($query3) == 0 AND mysqli_num_rows($query)==1) {
        array_push($errors, "User not activated");

    }

    $row1 = mysqli_fetch_array($query);
   


        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location:dashboard.php');
            } else {
                array_push($errors, "Wrong username/password combination");
            }
        }
    
}
  
  ?>