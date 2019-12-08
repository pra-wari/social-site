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
     
       if(isset($_POST["signup"])){
           $date = date('Y-m-d');
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
           $nophoto = "<p>Please choose photo.</p>";
           $wrongformat = "<p>You can upload photo only.</p>";
           $nameMissing = "<p>Please enter your name!</p>";
            $fileexist = "<p>File already exist !</p>";
           $genderMissing = "<p>Please select your gender!</p>";
           $emailMissing = "<p>Please enter your email!</p>";
           $invalidEmail = "<p>Please enter valid email!</p>";
           $addressMissing = "<p>Please enter your address!</p>";
           $professionMissing = "<p>Please select your profession!</p>";
         
           $error = "";
           if(!$name){
               $error.= $nameMissing;
           }else{
               $name = filter_var($name,FILTER_SANITIZE_STRING);
           }
           if(!$gender){
               $error.= $genderMissing;
           }
           if(!$email){
               $error.= $emailMissing;
           }else{
               $email = filter_var($email,FILTER_SANITIZE_STRING);
               if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                   $error .= $invalidEmail;
               }
           }
          
           if(!$profession){
               $error.= $professionMissing;
           }else{
               $profession = filter_var($profession,FILTER_SANITIZE_STRING);
           }
           if($fileerror==4){
               $error.= $nophoto;
           }else{
               if(file_exists($pd)){
                    $error.=$fileexist;
                }
               if($filesize>250*1024){
                   $error.=$toolarge;
               }
               if(!in_array($filetype,$allowedformat)){
                   $error.=$wrongformat;
               }
           }
         
          if($error){
         $result = '<div class="alert alert-warning">'.$error.'</div>';
         echo $result;
     }else{
            move_uploaded_file($tempname,$pd);
            $link = mysqli_connect("localhost:3306","buzztech_root","King@2000","buzztech_project1") or
                    die("unable to connect ".mysqli_connect_error());
            $name = mysqli_real_escape_string($link, $name);
            $gender = mysqli_real_escape_string($link, $gender);
            $email = mysqli_real_escape_string($link, $email);
            $address = mysqli_real_escape_string($link, $address);
            $profession = mysqli_real_escape_string($link, $profession);
            //$pd = mysqli_real_escape_string($link, $pd);
            $sql = "INSERT INTO users(name,gender,email,address,profession,status,photo,date) values('$name','$gender','$email','$address','$profession',0,'$pd','$date')";
            if(mysqli_query($link, $sql)){
                echo '<div class="alert alert-success">Thanks'
                . ' for signup you will be approved shortly.</div>';
            }else{
                echo '<div class="alert alert-warning">unable'
                . ' to add table.'. mysqli_error($link).'</div>';
            }
     }
       }
      ?>
        <div class="container-fluid contain col-sm-offet-1 col-sm-6">
            <h3 class="text-info" style="text-align: center;">Signup Form</h3>
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
                <textarea  name="address" id="address" class="form-control">
                </textarea>
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
            <input type="submit" name="signup" value="SignUP" 
                   class="btn btn-success btn-lg" id="signup">
            
            </form>
        </div>
    </body>
</html>



