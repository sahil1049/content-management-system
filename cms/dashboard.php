<?php 
include('server.php') ;
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}
$db = mysqli_connect('localhost', 'root', '', 'registration');
extract($_POST);
if(isset($_POST["insert"]))  
{  
     
    
                
    
}  
    

   
    
    // $query="INSERT INTO `users`(`username`,`password`,`email`,`status`) VALUES ('$username',
    // '$password','$email','$status')";
    // mysqli_query($db,$query);



?>


<!DOCTYPE html>  
<html>  
 <head>  
  <title>CMS</title>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <link rel="stylesheet" type="text/css" href="index.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
 </head>  
 <body>  
 <header>
<div id="header-inner">
<a href="index.php"> <img style="width:120px;height:40px;margin-top:20px"src="http://www.navonsoft.com/img/logo.png"></a>
  <nav>
    <a href="#" id="menu-icon"></a>
      <ul>
      <?php
      if(isset($_SESSION['username']))
      {
       echo('<li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" style="color:rgb(7, 69, 110)" href="dashboard.php?logout=true">Logout</a></li>');
      }
      ?>
      <li>  
        <button type="button" name="add" id="add" class="btn btn-success">
  Add Content
</button></li>
        
      </ul>
  </nav>
</div>
</header> 
  <br /><br />  
  <div class="container" style="width:900px;">  
 
   <br />
   <div id="image_data">

   </div>
  </div>  

<div id="imageModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Add Content</h4>
   </div>
   <div class="modal-body">
    <form id="content_form" method="post" enctype="multipart/form-data">
     <p><label>Select Image</label>
     <input type="file" name="image" id="image" /></p><br />
     <p><label>Select Video</label>
     <input type="file" name="video" id="video" /></p><br />
     <p><label>Link/Data</label><br>
     <input class="form-control" type="text" name="links" id="links" placeholder="links"/></p><br />
     <input type="hidden" name="action" id="action" value="insert" />
     <input type="hidden" name="image_id" id="image_id" />
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />
      
    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>
</body>  
</html>

<script>  
$(document).ready(function(){
 
 fetch_data();

 function fetch_data()
 {
  var action = "fetch";
  $.ajax({
   url:"userbackend.php",
   method:"POST",
   data:{action:action},
   success:function(data)
   {
    $('#image_data').html(data);
   }
  })
 }
 $('#add').click(function(){
  $('#imageModal').modal('show');
  $('#content_form')[0].reset();
  $('.modal-title').text("Add Content");
  $('#image_id').val('');
  $('#action').val('insert');
  $('#insert').val("Insert");
 });
 $('#content_form').submit(function(event){
  event.preventDefault();
  var image_name = $('#image').val();
  var video_name=$('#video').val();
  var links=$('#links').val();
  if(image_name == '' || video_name=="" || links=="")
  {
   alert("Please Select Content");
   return false;
  }
  else
  {
   var extension = $('#image').val().split('.').pop().toLowerCase();
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File");
    $('#image').val('');
    return false;
   }
   else
   {
    $.ajax({
     url:"userbackend.php",
     method:"POST",
     data:new FormData(this),
     contentType:false,
     processData:false,
     success:function(data)
     {
      alert(data);
      fetch_data();
      $('#content_form')[0].reset();
      $('#imageModal').modal('hide');
     }
    });
   }
  }
 });


 $(document).on('click', '.update', function(){
       
 
    
  
  $('#image_id').val($(this).attr("id"));
 
  $('#action').val("update");
  $('.modal-title').text("Update Content");
  $('#insert').val("Update");

  $('#imageModal').modal("show");
 });
 $(document).on('click', '.delete', function(){
  var image_id = $(this).attr("id");
  var action = "delete";
  if(confirm("Are you sure you want to remove this content from database?"))
  {
   $.ajax({
    url:"userbackend.php",
    method:"POST",
    data:{image_id:image_id, action:action},
    success:function(data)
    {
     alert(data);
     fetch_data();
    }
   })
  }
  else
  {
   return false;
  }
 });
});  
</script>