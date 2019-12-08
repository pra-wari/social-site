<?php
session_start();
?>
<html>
     <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Contact Form</title>
         <meta name="viewport" content="width=device-width,initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
         <style>
             .contain{
                 
                 height:auto;
             }
         </style> 
    </head>
    <body>

        <?php
          $rid =0;
          $rid = $_SESSION['rid'];
           if($rid==0){
               echo '<div class="alert alert-warning">Please login to upload files.</div>'; 
          }else{
              if(isset($_POST["upload"])){
            $filename = $_FILES['file']['name'];
            $filesize = $_FILES['file']['size'];
            $fileerror = $_FILES['file']['error'];
            $tempname = $_FILES['file']['tmp_name'];
            $filetype = $_FILES['file']['type'];
            $caption = $_POST["caption"];
            $pd = "uploads/".$_FILES['file']['name'];
           
            $allowedformat = array("image/jpg","image/jpeg","image/gif","image/png");
            
            $nofile = "<p>Please Choose a file!</p>";
            $toolargefile = "<p>Select file smaller than 5mb !</p>";
            $wrongformat = "<p>Please upload text or image files only !</p>";
            $alreadyexist = "<p>This file already exist in  directory !</p>";
            
                
            $error="";
            if($fileerror == 4){
                $error.= $nofile;
            }else{
                if($filesize > 5*1024*1024){
                    $error.=$toolargefile;
                }
                if(file_exists($pd)){
                    $error.=$alreadyexist;
                }
                if(!in_array($filetype,$allowedformat)){
                    $error.=$wrongformat;
                }
            }
            if($error){
                $result = '<div class="alert alert-warning">'.$error.'</div>';
                echo $result;
            }else{
                if(move_uploaded_file($tempname,$pd)){
                  
                   $link = mysqli_connect("localhost:3306","buzztech_root","King@2000","buzztech_project1") or
                    die("unable to connect ".mysqli_connect_error);
                    $sql = "INSERT INTO files(rid,url,caption) values('$rid','$pd','$caption')";
                    if(mysqli_query($link,$sql)){
                        $result = '<div class="alert alert-success">File Uploaded successfully.</div>';
                
                   }else{
                        $result = '<div class="alert alert-warning">Unable to insert into database !'.$fileerror.'</div>';
                    }
                   
                }
                else{
                    $result = '<div class="alert alert-warning">Unable to upload file try again later !'.$fileerror.'</div>';
                }
                echo $result;
            }
        }
          }
       
        
       
       
        if(isset($_POST["logout"])){
             
                 session_unset();
                 session_destroy();
                 $rid = 0;
                 echo '<div class="alert alert-warning">You have been logged out successfully </div>';
        } 
        
          if(isset($_POST["edit"])){
              
                echo "<script>window.location='file5.php?rid=$rid'</script>";
                
        }
        ?>

        <div class="container-fluid">
            <div class="row">
            <div class="col-md-4 contain">
                
                <?php
                  $link = mysqli_connect("localhost:3306","buzztech_root","King@2000","buzztech_project1") or
                    die("unable to connect ".mysqli_connect_error);
                  if(isset($_SESSION['rid'])){
                      $rid=$_SESSION['rid'];
                       $sql2 = "SELECT * FROM users WHERE id = '$rid'";
                     $s2 = mysqli_query($link,$sql2);
                     $row1 = mysqli_fetch_array($s2,MYSQLI_ASSOC);
                     $picadss = $row1['photo'];
                     $name = $row1['name'];
                     $gender = $row1['gender'];
                     $email = $row1['email'];
                     $adrss = $row1['address'];
                      echo "<img src = '$picadss' class='img-rounded' style='height:100px;width:100px;'><br/>";
                      echo "<div class='jumbotron'><strong>Name:&nbsp;</strong>".$name."<br/><strong>Gender:&nbsp;</strong>".$gender."<br/><strong>Email:&nbsp;</strong>".$email.
                      "<br/><strong>Address:&nbsp;</strong>".$adrss."</div>";
                  }
                ?>
              <form method="post" enctype="multipart/form-data">
                    <div class="form-group" style="margin:10% 0 0 0;">
                          
                    <input type="submit" name="edit" id="edit" class="btn btn-secondary btn-sm" value="Edit Profile"><br/><br/>
                    <label for="file"><strong> Select file:</strong></label>
                    <input type="file" name="file" id="file">
                      <label for="caption"><strong>Add caption:</strong></label>
                    <input type="text" name="caption" id="caption">
                    <input type="submit" name="upload" value="Upload" class="btn btn-success">
                    <input type="submit" name="logout" value="logout" class="btn btn-danger">
                </div>
              </form>
            </div>
            <div class="col-md-8 contain" id="uploadfiles">
                <h3 class="text-muted" style="text-align:center;">your uploaded files.</h3>
                <?php
                 
                  if($rid != 0){
                       $sql1 = "SELECT * FROM files WHERE rid = '$rid'";
                     $s = mysqli_query($link,$sql1);
                     
                     while($row = mysqli_fetch_array($s,MYSQLI_ASSOC)){
                         $adss = $row['url'];
                         $caption = $row['caption'];
                         echo "<div style='height:auto;width:50%; float:left;'>
                         <img src = '$adss' class='img-thumbnail' style='height:500px;width:100%;'>
                         <p class='text-muted'>$caption</P>
                         </div>";
                     }
                  }
                ?>
            </div>
            </div>
        </div>
       
    </body>
</html>

