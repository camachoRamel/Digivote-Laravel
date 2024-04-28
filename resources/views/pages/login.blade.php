<?php
    // session_start();

    // //function to log in
    // function logIn($username, $password){
    //     include "assets/tools/connect.php";

    //     $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";

    //     $result = mysqli_query($conn, $query);

    //     if($result && !empty($password) && !empty($username)){
    //         if(mysqli_num_rows($result) == 1){
    //             //log in success
    //             $row = $result->fetch_assoc();
    //             if(!isset($_SESSION['current_user_id'])){
    //                 $_SESSION['current_user_id'] = $row['user_id'];

    //             }if($_SESSION['current_user_id'] == 0){
    //                 //superAdmin.php does not exist yet
    //                 header('Location: assets/pages/superAdmin.php');
    //             }else if($_SESSION['current_user_id'] == 1){
    //                 header('Location: assets/pages/admin.php');
    //             }else if($_SESSION['current_user_id'] == 2){
    //                 //student.php does not exits yet
    //                 header('Location: assets/pages/verify.php');
    //             }

    //         }else{
    //             $errors['password'] = "Wrong password or username";
    //         }
    //     }
    //     mysqli_free_result($result);
    //     mysqli_close($conn);
    // }



    // $errors = ['username' => '', 'password' => ''];
    // $username = $password = '';

    // //called when a cookie is set
    // if(isset($_COOKIE['remember'])){
    //     $pieces = explode(',', $_COOKIE['remember']);
    //     $username = $pieces[0];
    //     $password = $pieces[1];

    //     logIn($username, $password);

    // }
    // if(isset($_POST['submit'])){
    //     if(empty($_POST['username'])){
    //         $errors['username'] = 'Empty username field <br>';
    //     }else{
    //         $username = $_POST['username'];
    //     }

    //     if(empty($_POST['password'])){
    //         $errors['password'] = 'Empty password field <br>';
    //     }else{
    //         $password = $_POST['password'];
    //     }

    //     //sets the cookie
    //     if(isset($_POST['remember_me'])){
    //         setcookie('remember', $username . ',' . $password);
    //     }
    //     logIn($username, $password);
    // }

    // require_once 'twilio-php-app/vendor/autoload.php';
    // use Twilio\Rest\Client;

    // $sid    = "ACfbf13411731d1dac13e08c35d0b9e49d";
    // $token  = "dd4e053650f1cd473d400233d64d596d";
    // $twilio = new Client($sid, $token);

    // $message = $twilio->messages
    //   ->create("+639476168206", // to
    //     array(
    //       "from" => "+12138085553",
    //       "body" => 9999
    //     )
    //   );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
</head>
<body>
    <main class="d-flex justify-content-center align-items-center vh-100">
        <div class="container-xs p-5 border rounded border-dark">
            <form name="form" action="" method="POST">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="username" id="floatingInput username" placeholder="Username">
                  <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingPassword password" name="password" placeholder="Password">
                  <label for="floatingPassword">Password</label>
                </div>

                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" name="remember_me" value="1" id="rememberPasswordCheck">
                  <label class="form-check-label" for="rememberPasswordCheck">
                    Remember password
                  </label>
                </div>

                <div class="d-grid">
                  <button class="btn btn-lg btn-dark btn-login text-uppercase fw-bold mb-2" type="submit" name="submit">Sign in</button>
                  <div class="text-center">
                    <a class="small" href="#forgot-pass.php">Forgot password?</a>
                  </div>
                </div>
              </form>
        </div>
    </main>
</body>
</html>
