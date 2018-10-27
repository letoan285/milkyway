<?php 

session_start();
$email = $_SESSION['email'];
$password = $_SESSION['password'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head> 
    <div class="container page-wrapper">
        <div class="wrapper">
            <div class="col-6 text-center">
                <form class="form" action="app/views/auth/login.php" method="post">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success button-submit">Login</button>
                    </div>
                
                </form>
            
            </div>
        </div>
    </div>
    
</body>
</html>