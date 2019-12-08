<?php
session_start();
?>

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
        if(isset($_POST["email"])){
        $email = $_POST["email"];
      
         $link = mysqli_connect("localhost:3306","buzztech_root","King@2000","buzztech_project1") or
                    die("unable to connect ".mysqli_connect_error);
        $sql = "SELECT * FROM users WHERE email = '$email'";
       
        $status = mysqli_query($link, $sql);
     
          $st = mysqli_fetch_array($status);
            $n = $st['status'];
            $_SESSION['rid'] = $st['id'];
            //echo $n;
          // print_r($status);
            //echo $st["status"];
            //echo $st["name"];
         
          if($n==0){
              echo '<div class="alert alert-danger">You are not approved yet.</div>';
             
          }
          else{
              
              echo '<script>window.location = "file3.php"</script>';
                
          }
        }
       
        ?>
        <div class="container-fluid contain col-sm-offet-1 col-sm-6">
            <form method="post">
                <div class="form-group">
                    <label for="email"><strong>Email:</strong></label>
                <input type="email" name="email" id="email" class="form-control"><br/>
                <input type="submit" name="login" value="Login" class="btn btn-success btn-lg">
            </div>
            </form>
        </div>
    </body>
</html>

