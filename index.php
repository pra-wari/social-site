<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>mysite</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;Prashant Tiwari</a>
        <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
          <span class="sr-only"> nanvbar toggle</span>
           <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse" id="navbarCollapse">
        <ul class=" nav navbar-nav navbar-right">
            <li><a href="file1.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Signup</a></li>
            <li><a href="file2.php"> <span class="glyphicon glyphicon-log-in"></span>&nbsp;Login</a></li>
        </ul>
    </div>
</div>
</nav>
<h1 class='text-muted' style=' text-align:center;margin-top:50px;'>All uploaded files</h1>
<div class="container-fluid col-md-12">
     <?php
                      $link = mysqli_connect("localhost:3306","buzztech_root","King@2000","buzztech_project1") or
                    die("unable to connect ".mysqli_connect_error);
                    
                   $sql1 = "SELECT * FROM files";
                     $s = mysqli_query($link,$sql1);
                     
                     while($row = mysqli_fetch_array($s,MYSQLI_ASSOC)){
                         $adss = $row['url'];
                         $caption = $row['caption'];
                         echo "<div style='height:auto;width:50%;float:left;padding:10px; '>
                         <img src = '$adss' class='img-thumbnail' style='height:500px;width:100%;'>
                         <h1 class='text-info'>$caption</h1><br/>
                         </div>";
                     }
                  
    ?>
    <?php
       $link = mysqli_connect("localhost:3306","buzztech_root","King@2000","buzztech_project1") or
                    die("unable to connect ".mysqli_connect_error);
            $sql="select date from users";
            $s=mysqli_query($link,$sql);
            while($row=mysqli_fetch_assoc($s)){
                $date1=$row['date'];
                $status = $row['status'];
                $date2=date('Y-m-d');
                $x = date_create($date1);
                 $y = date_create($date2);
               
                $diff=date_diff($x,$y);
                $z= $diff->format("%R%a ");
              
           
              if($z>7 && $status==0){
                  $sql = "DELETE FROM users where date='$date1'";
                  mysqli_query($link,$sql);
              }
               
            }
                    
                    
                    
                    
                    
    ?>
</div>
</body>
</html>

