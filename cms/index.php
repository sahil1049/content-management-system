<?php include('server.php') 
?>
<html>
  
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CMS</title>
  <link rel="stylesheet" type="text/css" href="index.css">
 </head>  
<body>
  <header>
    <div id="header-inner">
    <img style="width:120px;height:40px;margin-top:20px"src="http://www.navonsoft.com/img/logo.png">
    
      <nav>
        <a href="#" id="menu-icon"></a>
          <ul>
          <?php
          if(isset($_SESSION['username']))
          {
           echo('<li><a style="color:rgb(7, 69, 110)" href="dashboard.php" >Dashboard</a></li>');
          }
          ?>
             <li><a style="color:rgb(7, 69, 110)" href="login.php" >Login</a></li>
             <li><a style="color:rgb(7, 69, 110)"href="register.php">Sign Up</a></li>
            
          </ul>
      </nav>
    </div>
  </header> 
  <!---end of header--->
  <section class="banner">
    <div class="banner-inner">
      <img class="ban" src="https://pngimage.net/wp-content/uploads/2018/05/content-management-system-png-2.png">
    </div>
  </section>
  <!--end of banner-->
  

  <!--end second footer-->
  </body>  
  </html>