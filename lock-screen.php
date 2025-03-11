<?php require 'config.php';
session_start();

if(!isset($_SESSION['lock'])) {
    // User is not logged in or session expired, redirect to the sign-in page
    header("Location: ./");
    exit;
}
// Check if the user is already logged in
if(!isset($_SESSION['ad_id'])) {
    // User is not logged in or session expired, redirect to the sign-in page
    header("Location: signin.php");
    exit;
}
// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the user's credentials (this is just a basic example)
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform authentication logic here (e.g., check against a database)
    $query = "SELECT ad_id, password FROM admin WHERE ad_email='$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // User found, verify the password
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            // Password is correct, generate and store the session ID
            $ad_id = $row['ad_id'];
            $session_id = generateSessionId();

            // Store the session ID and user_id in session variables
            $_SESSION['session_id'] = $session_id;
            $_SESSION['ad_id'] = $ad_id;
            unset($_SESSION['lock']);
            if (isset($_SESSION['redirect_url'])) {
                // Redirige al usuario al panel de control u otra página segura
                header("Location: {$_SESSION['redirect_url']}");
                exit;
            } else {
                header("Location: ./");
                exit;
            }

        } else {
            // Authentication failed
            $error ="Invalid password";
        }
    } else {
        // Authentication failed
        $error = "Invalid email";
    }
}else{
    $error = "";
}

// Function to generate a session ID
function generateSessionId() {
    // Generate a random session ID
    $sessionId = bin2hex(random_bytes(16)); // Generate 16 bytes of random data and convert to hexadecimal
    return $sessionId;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Lock-screen - Pos admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="account-page">

<div class="main-wrapper">
    <div class="account-content">
        <div class="login-wrapper">
            <?php
                $ad_id = $_SESSION['ad_id'];
                $sql_main = "SELECT * FROM admin WHERE ad_id =  '$ad_id'";
                $result_main = mysqli_query($con, $sql_main) or die(mysqli_error($con));
                $row_main = mysqli_fetch_assoc($result_main);
            ?>
            <div class="login-content">
                <div class="login-userset">
                    <div class="text-center">
                        <div class="row">
                            <div class="col">
                                <div class="login-logo">
                                    <img src="assets/img/logo.png" alt="img">
                                </div>
                            </div>
                            <div class="col">
                                <div class="profileset">
                                    <span class="lock-user-img"><img src="assets/img/profiles/<?php echo $row_main['ad_img'];?>" alt="User Avatar" class="rounded-circle lock-user-avatar"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="login-userheading">
                        <h3>Locked Profile</h3>
                        <h4>Please enter your password to unlock</h4>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <?php if ($error != "") {
                                echo '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">'
                                    . $error .
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                            }
                            ?>
                        <div class="form-login">
                            <h5>Bonjour , <?php echo $row_main['ad_name'];?> !</h5>
                        </div>
                        <div class="form-login">
                            <label>Password</label>
                            <div class="pass-group">
                                <input type="hidden" name="email" value="<?php echo $row_main['ad_email'];?>">
                                <input type="password" name="password" class="pass-input" placeholder="Enter your password">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login">
                            <div class="alreadyuser">
                                <h4><a href="forgetpassword.html" class="hover-a">Forgot Password?</a></h4>
                            </div>
                        </div>
                        <div class="form-login">
                            <button id="submit" name="mod_mdp" class="btn btn-login">Sign In</button>
                        </div>
                    </form>
                    <div class="signinform text-center">
                        <h4>Don’t have an account? <a href="signup.html" class="hover-a">Sign Up</a></h4>
                    </div>
                    <div class="form-setlogin">
                        <h4>Or sign up with</h4>
                    </div>
                    <div class="form-sociallink">
                        <ul>
                            <li>
                            <a href="javascript:void(0);">
                            <img src="assets/img/icons/google.png" class="me-2" alt="google">
                            Sign Up using Google
                            </a>
                            </li>
                            <li>
                            <a href="javascript:void(0);">
                            <img src="assets/img/icons/facebook.png" class="me-2" alt="google">
                            Sign Up using Facebook
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="login-img">
                <img src="assets/img/login.jpg" alt="img">
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#login').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: 'signin.php',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        window.location.href = "./";
                    } else {
                        $('#message').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.error+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }
                }
            });
        });
    });
</script>
<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>