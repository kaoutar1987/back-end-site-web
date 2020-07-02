
<?php
session_start();
     require_once "db.php";
     $message = "";
 
     if(isset($_SESSION['id'])!="") {
        header("Location:blog.php");
    
}
 
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
 
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $email_error = "Please Enter Valid Email ";
    }
    if(strlen($password) < 6) {
        $password_error = "Password must be minimum of 6 characters";
    }  
 
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email. "' &&  password = '" . md5($password). "'");
    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['mobile'] = $row['mobile'];
        $_SESSION['email'] = $row['email'];
        header("Location:blog.php");
    } else {
        $error_message = "Incorrect Email or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Perfect Cup - Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

         <!-- <script src="js/script.js" defer></script> -->
</head>

<body>
<div class="brand">The Perfect Cup</div>
    <div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>

    <!-- Navigation -->
    <?php include "navbar.php"?>
    
    <div class="container">
        <div class="row ">
            <div class="box ">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">login
                    <strong>form</strong>    
                    </h2>
                    <hr>
                    <div id="add_err2"><?php echo $message ?></div>
                    <span class="text-danger"><?php if (isset($error_message)) echo $error_message; ?></span>
                    <form role="form" action ="login.php" method="post">
                        <div class="form-group ">
                         <label>Email</label>
                         <input type="email" name="email" class="form-control" value="" maxlength="30" required="">
                         <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                          </div> 
                         <div class="form-group">
                          <label>Password</label>
                           <input type="password" name="password" class="form-control" value="" maxlength="8" required="">
                          <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                         </div>  
                          <input type="submit" class="btn btn-primary" name="login" value="submit">
                          <br>
                           You don't have account?<a href="register.php" class="mt-3">Click Here</a>           
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; The Perfect Cup 2019</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>








 
