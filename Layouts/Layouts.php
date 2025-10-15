<?php
class Layouts {
    public function header($conf) {
        ?>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
            <meta name="generator" content="Hugo 0.101.0">
            <title>Jumbotron Template · Bootstrap v4.6</title>

            <link rel="canonical" href="https://https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css">
            <!-- Bootstrap core CSS -->
            <link href="https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
            <!-- Font Awesome -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
            <!-- Favicons -->
            <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
            <link rel="icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
            <link rel="icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
            <link rel="manifest" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/manifest.json">
            <link rel="mask-icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
            <link rel="icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/favicon.ico">
            <meta name="msapplication-config" content="/docs/4.6/assets/img/favicons/browserconfig.xml">
            <meta name="theme-color" content="#563d7c">
            <style>
                .bd-placeholder-img {
                    font-size: 1.125rem;
                    text-anchor: middle;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                }

                @media (min-width: 768px) {
                    .bd-placeholder-img-lg {
                        font-size: 3.5rem;
                    }
                }
            </style>
            <!-- Custom styles for this template -->
            <link href="https://https://getbootstrap.com/docs/4.6/dist/css/jumbotron.css" rel="stylesheet">
        </head>
        <?php
    }
public function navbar($conf){
        // Get the current page filename
        $current_page = basename($_SERVER['PHP_SELF']);
        
        // Check if user is logged in
        $is_logged_in = isset($_SESSION['user_id']);
        ?>
    <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="index.php">StrathEventique</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo ($current_page == 'index.php' || $current_page == 'home.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php">Home <?php echo ($current_page == 'index.php' || $current_page == 'home.php') ? '<span class="sr-only">(current)</span>' : ''; ?></a>
                </li>
                
                <?php if(!$is_logged_in): ?>
                <li class="nav-item <?php echo ($current_page == 'signin.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="signin.php">Sign In <?php echo ($current_page == 'signin.php') ? '<span class="sr-only">(current)</span>' : ''; ?></a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'signup.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="signup.php">Sign Up <?php echo ($current_page == 'signup.php') ? '<span class="sr-only">(current)</span>' : ''; ?></a>
                </li>
                <?php endif; ?>
            </ul>
            
            <?php if($is_logged_in): ?>
            <!-- User Profile Dropdown -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Profile'; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> My Profile</a>
                        <a class="dropdown-item" href="settings.php"><i class="fas fa-cog"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
            </ul>
            <?php endif; ?>
        </div>
    </nav>
<?php
}

public function banner($conf){
    ?>
        <main role="main">

    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Hello, world!</h1>
            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
        </div>
    </div>
    <?php
}
    public function content($conf){
        ?>
        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <h2>Heading</h2>
                    <p>Will you do the same for me? It's time to face the music I'm no longer your muse. Heard it's beautiful, be the judge and my girls gonna take a vote. I can feel a phoenix inside of me. Heaven is jealous of our love, angels are crying from up above. Yeah, you take me to utopia.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Heading</h2>
                    <p>Standing on the frontline when the bombs start to fall. Heaven is jealous of our love, angels are crying from up above. Can't replace you with a million rings. Boy, when you're with me I'll give you a taste. There’s no going back. Before you met me I was alright but things were kinda heavy. Heavy is the head that wears the crown.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Heading</h2>
                    <p>Playing ping pong all night long, everything's all neon and hazy. Yeah, she's so in demand. She's sweet as pie but if you break her heart. But down to earth. It's time to face the music I'm no longer your muse. I guess that I forgot I had a choice.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div>
            </div>

            <hr>

        </div> <!-- /container -->

</main>
        <?php
    }

    public function footer($conf){
        ?>
        <footer class="container">
            <p>&copy; Company 2017-2024</p>
        </footer>


        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>


        </body>
        </html>
        <?php
    }
    public function signin($conf){
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>Sign In - StrathEventique</title>

            <!-- Bootstrap CSS -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
            <!-- MDB CSS -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">
            <!-- Font Awesome -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

            <style>
                .bg-image-vertical {
                    position: relative;
                    overflow: hidden;
                    background-repeat: no-repeat;
                    background-position: right center;
                    background-size: auto 100%;
                }

                @media (min-width: 1025px) {
                    .h-custom-2 {
                        height: 100%;
                    }
                }
            </style>
        </head>
        <body>

        <?php
        // Display message if exists
        if(isset($_SESSION['msg'])) {
            echo '<div class="alert alert-' . $_SESSION['msg_type'] . ' alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 300px;">';
            echo $_SESSION['msg'];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '</div>';
            unset($_SESSION['msg']);
            unset($_SESSION['msg_type']);
        }
        ?>

        <section class="vh-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 text-black">

                        <div class="px-5 ms-xl-4">
                            <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                            <span class="h1 fw-bold mb-0">StrathEventique</span>
                        </div>

                        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                            <form style="width: 23rem;" method="post">
                                <input type="hidden" name="signin" value="1">

                                <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="email" name="email" id="form2Example18" class="form-control form-control-lg" required />
                                    <label class="form-label" for="form2Example18">Email address</label>
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" name="password" id="form2Example28" class="form-control form-control-lg" required />
                                    <label class="form-label" for="form2Example28">Password</label>
                                </div>

                                <div class="pt-1 mb-4">
                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                                </div>

                                <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                                <p>Don't have an account? <a href="signup.php" class="link-info">Register here</a></p>

                            </form>

                        </div>

                    </div>
                    <div class="col-sm-6 px-0 d-none d-sm-block">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp"
                             alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                    </div>
                </div>
            </div>
        </section>

        <!-- Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
        <!-- MDB JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
        </body>
        </html>
        <?php
    }
    public function signup($conf){
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Create Account</title>

            <!-- Bootstrap CSS -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

            <!-- MDB CSS -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">

            <style>
                .gradient-custom-3 {
                    background: linear-gradient(to right, rgba(3, 3, 3, 0.5), rgba(143, 211, 244, 0.5));
                }
                .gradient-custom-4 {
                    background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));
                }
            </style>
        </head>
        <body>
        <section class="vh-100 bg-image"
                 style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                                    <form method="post">
                                        <input type="hidden" name="signup" value="1">

                                        <div class="form-outline mb-4">
                                            <input type="text" name="fullname" class="form-control form-control-lg" required />
                                            <label class="form-label">Your Name</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="email" name="email" class="form-control form-control-lg" required />
                                            <label class="form-label">Your Email</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" name="password" class="form-control form-control-lg" required />
                                            <label class="form-label">Password</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" name="password_repeat" class="form-control form-control-lg" required />
                                            <label class="form-label">Repeat your password</label>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" required />
                                            <label class="form-check-label">
                                                I agree to all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit"
                                                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                                                Register
                                            </button>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
        <!-- MDB JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
        </body>
        </html>

        <?php
    }
    public function verify($conf){
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Verify Account - StrathEventique</title>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">
            <style>
                .gradient-custom-3 {
                    background: linear-gradient(to right, rgba(3, 3, 3, 0.5), rgba(143, 211, 244, 0.5));
                }
                .verification-container {
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                }
            </style>
        </head>
        <body>
        <section class="verification-container">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-lg" style="border-radius: 15px;">
                            <div class="card-body p-5 text-center">
                                <div class="mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-envelope-check text-primary" viewBox="0 0 16 16">
                                        <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                                        <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
                                    </svg>
                                </div>
                                
                                <h2 class="mb-3">Verify Your Account</h2>
                                <p class="text-muted mb-4">We've sent a verification code to your email address. Please enter it below to complete your registration.</p>

                                <?php
                                if(isset($_SESSION['msg'])) {
                                    $msg_type = isset($_SESSION['msg_type']) ? $_SESSION['msg_type'] : 'info';
                                    echo '<div class="alert alert-' . $msg_type . ' alert-dismissible fade show" role="alert">';
                                    echo $_SESSION['msg'];
                                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                                    echo '</div>';
                                    unset($_SESSION['msg']);
                                    unset($_SESSION['msg_type']);
                                }
                                ?>

                                <form method="post">
                                    <input type="hidden" name="verify_account" value="1">

                                    <div class="form-outline mb-4">
                                        <input type="text" name="verification_code" class="form-control form-control-lg text-center" 
                                               placeholder="Enter 6-digit code" maxlength="6" required autofocus 
                                               pattern="[0-9]{6}" title="Please enter a 6-digit code"/>
                                        <label class="form-label">Verification Code</label>
                                    </div>

                                    <div class="d-grid gap-2 mb-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            Verify Account
                                        </button>
                                    </div>

                                    <div class="text-center">
                                        <p class="mb-0">Didn't receive the code?</p>
                                        <a href="?resend=1" class="text-primary">Resend verification code</a>
                                    </div>
                                </form>

                                <hr class="my-4">

                                <p class="text-muted small">
                                    <a href="signup.php">Back to Sign Up</a> | 
                                    <a href="signin.php">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
        </body>
        </html>
        <?php
    }
}