<html>
       <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
         <title>Contact Form</title>
         <meta name="viewport" content="width=device-width,initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
         <style>
             .contain{
                 border:1px solid black;
                 border-radius: 10px;
                 margin-top: 5%;
                 padding: 20px;
                 
             }
         </style>
    </head>
    <body>
        <?php
        if(isset($_GET['rid'])){
            
        $rid=$_GET['rid'];
        if(isset($_POST["signup"])){
             $filename = $_FILES['file']['name'];
           $filesize = $_FILES['file']['size'];
           $filetype = $_FILES['file']['type'];
           $fileerror= $_FILES['file']['error'];
           $tempname =  $_FILES['file']['tmp_name'];
           $pd = "uploads/".$filename;
           $name = $_POST["name"];
           $gender = $_POST["gender"];
           $email = $_POST["email"];
           $address = $_POST["address"];
           $profession = $_POST["id"];
           $allowedformat = array("image/jpg","image/jpeg","image/gif","image/png");
           $toolarge = "<p>Please choose photo less than 250 kb.</p>";
           $wrongformat = "<p>You can upload photo only.</p>";
           $fileexist = "<p>File already exist</p>";
           $error ="";
           if($fileerror!=4){
               if(file_exists($ps)){
                   $error.= $fileexist;
               }
               if($filesize>250*1024){
                  $error.= $toolarge;
               }
               if(!in_array($filetype,$allowedformat)){
                   $error.= $wrongformat;
               }
           }
           if($error){
               echo '<div class="alert alert-danger">'.$error.'</div>';
           }else{
                  move_uploaded_file($tempname,$pd);
            $link = mysqli_connect("localhost:3306","buzztech_root","King@2000","buzztech_project1") or
                    die("unable to connect ".mysqli_connect_error());
                    if($name){
                       $sql = "UPDATE users SET name ='$name'  WHERE id = '$rid'";
                       mysqli_query($link,$sql);
                    }
                     if($gender){
                       $sql = "UPDATE users SET gender ='$gender'  WHERE id = '$rid'";
                       mysqli_query($link,$sql);
                    }
                     if($email){
                       $sql = "UPDATE users SET email ='$email'  WHERE id = '$rid'";
                       mysqli_query($link,$sql);
                    }
                     if($address){
                       $sql = "UPDATE users SET address ='$address'  WHERE id = '$rid'";
                       mysqli_query($link,$sql);
                    }
                     if($profession){
                       $sql = "UPDATE users SET profession ='$profession'  WHERE id = '$rid'";
                       mysqli_query($link,$sql);
                    }
                     if($filename){
                       $sql = "UPDATE users SET photo ='$pd'  WHERE id = '$rid'";
                       mysqli_query($link,$sql);
                    }
                     echo '<div class="alert alert-success">Your information updated.</div>';
                     echo '<script>window.location="file3.php"</script>';
                  
               }
           
        }
        }
        ?>
        <div class="container-fluid contain col-sm-offet-1 col-sm-6">
            <h3 class="text-info" style="text-align: center;">Edit Profile</h3>
            <form method="post" enctype="multipart/form-data">
           
            <div class="form-group" >
                <label for="name"><strong>Name:</strong></label>
                <input type="text" name="name" id="firstName" class="form-control" 
                       value="<?php if(isset($_POST["submit"])) echo $_POST["name"];?>">
            </div>
            <div class="form-group">
                <label for="gender"><strong>Gender:</strong></label>&nbsp;
                &nbsp; <input type="radio" name="gender" id="gender" value="male" >
                Male &nbsp; <input type="radio" name="gender" id="gender" value="female">
                Female 
            </div>
            <div class="form-group">
                <label for="email"><strong>Email:</strong></label>
                <input type="email" name="email" id="email" class="form-control"
                       value="<?php if(isset($_POST["submit"])) echo $_POST["email"];?>">
            </div>
            <div class="form-group">
                <label for="address"><strong>Address:</strong></label>
                <input  name="address" id="address" class="form-control">
             
            </div>
            <div class="form-group">
                <label for="file"><strong>Choose photo:</strong></label>
                <input type="file" name="file" id="file" >
            </div>
             <div class="form-group">
                <label for="id"><strong>Select:</strong></label>&nbsp;
                &nbsp; <input type="radio" name="id" id="id" value="teacher">
                Teacher &nbsp; <input type="radio" name="id"  value="student" >
                Student 
            </div>
            <input type="submit" name="signup" value="OK" 
                   class="btn btn-info btn-sm" id="signup">
            
            </form>
        </div>
    </body>
</html>