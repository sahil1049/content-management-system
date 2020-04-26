<?php
include('server.php');
$connect = mysqli_connect("localhost", "root", "", "registration");
//action.php
if(isset($_POST["action"]))
{
 
 if($_POST["action"] == "fetch")

 {
    $username=$_SESSION['username'];
    $query = "SELECT * FROM content where username='$username'";
    $result = mysqli_query($connect, $query);

  $output = '
   <table class="table table-bordered table-striped">  
    <tr>
     <th width="10%">ID</th>
     <th width="70%">Image</th>
     <th width="70%">Video</th>
     <th width="70%">Other Link/Data</th>
     <th width="10%">Change</th>
     <th width="10%">Remove</th>
    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
    $location=$row['video_location'];
   $output .= '
    
    <tr>
     <td>'.$row["id"].'</td>
     <td>
      <img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="200px" width="320px" class="img-thumbnail" />
     </td>
     <td>
     <video src='.$location.' controls width="320px" height="200px" >
     </td>
     <td>
     ' .$row["otherlink"].'
     </td>
    
     <td><button type="button" name="update" class="btn btn-warning bt-xs update"  id="'.$row["id"].'">Change</button></td>
     <td><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["id"].'">Remove</button></td>
    </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }
}
 if($_POST["action"] == "insert")
 {
     $link=$_POST['links'];
  $maxsize = 5242880; // 5MB
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));     
            $name = $_FILES['video']['name'];
            $target_dir = "videos/";
            $target_file = $target_dir . $_FILES["video"]["name"];

            // Select file type
            $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

            // Check extension
            if( in_array($videoFileType,$extensions_arr) ){
                
                // Check file size
                if(($_FILES['video']['size'] >= $maxsize) || ($_FILES["video"]["size"] == 0)) {
                    echo "File too large. File must be less than 5MB.";
                }else{
                    // Upload
                    if(move_uploaded_file($_FILES['video']['tmp_name'],$target_file)){
                        // Insert record
                        $username=$_SESSION['username'];
                        $query1 = "INSERT INTO content (username,image,video_name,video_location,otherlink) VALUES('".$username."','".$file."','".$name."','".$target_file."','".$link."')";

                      
                        if(mysqli_query($connect, $query1))
                        {
                         echo 'Content Inserted into Database';
                        }
                       
                    }
                }
              }
  
 
 
 }
 if($_POST["action"] == "update")
 {
 
  $link=$_POST['links'];
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  $maxsize = 5242880; // 5MB
  $name = $_FILES['video']['name'];
            $target_dir = "videos/";
            $target_file = $target_dir . $_FILES["video"]["name"];

            // Select file type
            $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

            // Check extension
            if( in_array($videoFileType,$extensions_arr) ){
                
                // Check file size
                if(($_FILES['video']['size'] >= $maxsize) || ($_FILES["video"]["size"] == 0)) {
                    echo "File too large. File must be less than 5MB.";
                }else{
                    // Upload
                    if(move_uploaded_file($_FILES['video']['tmp_name'],$target_file)){
                        // Insert record
                        $query = "UPDATE content SET image = '$file', video_name='$name',video_location='$target_file',otherlink='$link' WHERE id = '".$_POST["image_id"]."'";

                        mysqli_query($connect,$query);
                        if(mysqli_query($connect, $query))
                        {
                         echo 'Content updated into Database';
                        }
                       
                    }
                }
              }

  

 }
 if($_POST["action"] == "delete")
 {
   
  $query = "DELETE FROM content WHERE id = '".$_POST["image_id"]."'";
  $query1="SELECT * from content where id='".$_POST["image_id"]."'";
  $result=mysqli_query($connect, $query1);
  $row=mysqli_fetch_array($result);
  $video=$row['video_name'];
  $file_to_delete = "videos/".$video;
  unlink($file_to_delete);
  if(mysqli_query($connect, $query))
  {
   echo 'Content Deleted from Database';
  }
}

?>