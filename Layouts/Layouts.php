<?php
class Layouts {
    public function header($conf) {
        $title = isset($conf['title']) && $conf['title'] !== '' ? $conf['title'] : 'StrathEventique';
        ?>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
            <meta name="generator" content="Hugo 0.101.0">
            <title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>

            <link rel="canonical" href="https://https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css">
            <!-- Bootstrap core CSS -->
            <link href="https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
            <!-- Font Awesome -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
            <!-- Favicons -->
            <link rel="icon" href="assets/StrathEventique_Logo.png" type="image/png">
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

            <!-- >>> Added: navy & gold color scheme overrides -->
            <style>
                :root{
                  --navy: #0a2540;
                  --navy-dark: #071a30;
                  --gold: #D4AF37;
                  --gold-dark: #b98f2b;
                }

                /* Navbar */
                .navbar.bg-primary, .navbar.bg-dark { background-color: var(--navy) !important; }
                .navbar-brand { color: var(--gold) !important; font-weight: 600; }
                .navbar-dark .navbar-nav .nav-link { color: rgba(212,175,55,0.95) !important; }
                .navbar-dark .navbar-nav .nav-link:hover, .navbar-dark .navbar-nav .nav-link:focus,
                .navbar-dark .navbar-nav .nav-link.active { color: #fff !important; text-shadow: 0 0 6px rgba(10,37,64,0.2); }

                /* Buttons / utilities */
                .btn-primary, .bg-primary { background-color: var(--navy) !important; border-color: var(--navy) !important; color: var(--gold) !important; }
                .btn-primary:hover, .btn-primary:focus { background-color: var(--navy-dark) !important; border-color: var(--navy-dark) !important; color: #fff !important; }

                /* Map other common button colors used in pages */
                .btn-info, .btn-success { background-color: var(--navy) !important; border-color: var(--navy) !important; color: var(--gold) !important; }
                .btn-info:hover, .btn-success:hover { background-color: var(--navy-dark) !important; border-color: var(--navy-dark) !important; color: #fff !important; }

                /* Light / accent backgrounds -> gold */
                .bg-light { background-color: var(--gold) !important; color: var(--navy) !important; }
                .text-muted { color: rgba(0,0,0,0.55) !important; }

                /* Jumbotron / hero tweaks */
                .jumbotron { background-color: var(--navy) !important; color: var(--gold) !important; }
                .jumbotron .lead, .jumbotron p { color: rgba(212,175,55,0.95); }

                /* Utility for gold text where needed */
                .text-gold { color: var(--gold) !important; }

                /* Cards and subtle borders */
                .card { border-color: rgba(10,37,64,0.08); }

                /* Placeholder background helper for signup */
                .placeholder-bg { background-image: url('assets/images/signup-bg-placeholder.jpg'); background-size: cover; background-position: center; }
            </style>
            <!-- <<< end overrides -->
        </head>
    <?php

    }

    public function navbar($conf){
        $current_page = basename($_SERVER['PHP_SELF']);
        $is_logged_in = isset($_SESSION['user_id']);
        ?>

        <!-- CSS for the navbar hide/show transition -->
        <style>
            .navbar {
                transition: top 0.3s ease-in-out;
            }
        </style>

        <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/StrathEventique_Logo.png" alt="StrathEventique Logo" style="height: 35px;" class="me-2">
                <span>StrathEventique</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php echo ($current_page == 'events.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="events.php">Events</a>
                    </li>

                    <?php if(!$is_logged_in): ?>
                        <li class="nav-item <?php echo ($current_page == 'signin.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="signin.php">Sign In</a>
                        </li>
                        <li class="nav-item <?php echo ($current_page == 'signup.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="signup.php">Sign Up</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <?php if($is_logged_in): ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-circle"></i>
                                <?php
                                // Start with the user's name or a default 'Profile'
                                $displayName = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Profile';

                                // If the user's role is 'admin', append the label
                                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
                                    $displayName .= ' (Admin)';
                                }

                                echo $displayName;
                                ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> My Dashboard</a>
                                <a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> My Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </nav>

        <!-- JavaScript for the scroll detection logic -->
        <script>
            let lastScrollTop = 0;
            const navbar = document.querySelector('.navbar');

            window.addEventListener("scroll", function() {
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                if (scrollTop > lastScrollTop) {
                    // Scrolling Down
                    navbar.style.top = "-80px"; // Hides the navbar by moving it up
                } else {
                    // Scrolling Up
                    navbar.style.top = "0"; // Shows the navbar by moving it back to the top
                }
                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
            }, false);
        </script>
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
            <p>&copy; StrathEventique 2025</p>
        </footer>


        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>


        </body>
        </html>
        <?php

    }
    public function create_event_layout_header($conf) {
        $title = isset($conf['title']) && $conf['title'] !== '' ? $conf['title'] : 'StrathEventique';
        ?>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>

            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet">

            <link rel="icon" href="assets/StrathEventique_Logo.png" type="image/png">
            <style>
                /* Your root color variables */
                :root{
                    --navy: #0a2540;
                    --gold: #D4AF37;
                }
                .btn-primary {
                    background-color: var(--navy) !important;
                    color: var(--gold) !important;
                }
            </style>
        </head>
        <?php
    }

    public function create_event_layout_footer($conf) {
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
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

            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

            <style>
                /* ensure standalone signin page uses same palette */
                :root{
                    --navy: #0a2540;
                    --navy-dark: #071a30;
                    --gold: #D4AF37;
                    --gold-dark: #b98f2b;
                }
                .btn-primary, .btn-info { background-color: var(--navy) !important; border-color: var(--navy) !important; color: var(--gold) !important; }
                .btn-primary:hover, .btn-info:hover { background-color: var(--navy-dark) !important; color: #fff !important; }

                /* Added styles from signup for consistency */
                .gradient-custom-3 {
                    background: linear-gradient(90deg, rgba(10,37,64,0.9) 0%, rgba(10,37,64,0.7) 100%);
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

        <section class="vh-100 bg-image" style="background-image: url('https://strathmore.edu/wp-content/uploads/2023/12/Artboard-1.png');">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">

                                    <div class="text-center mb-4">
                                        <img src="assets/StrathEventique_Logo.png" alt="StrathEventique Logo" style="height: 80px;" class="me-3">
                                        <h2 class="text-uppercase text-center d-inline-block align-middle">StrathEventique</h2>
                                    </div>

                                    <h3 class="fw-normal mb-4 text-center" style="letter-spacing: 1px;">Log In</h3>

                                    <form method="post">
                                        <input type="hidden" name="signin" value="1">

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" name="email" id="form2Example18" class="form-control form-control-lg" required />
                                            <label class="form-label" for="form2Example18">Email address</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password" id="form2Example28" class="form-control form-control-lg" required />
                                            <label class="form-label" for="form2Example28">Password</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                                        </div>

                                        <div class="text-center">
                                            <p class="small mb-3"><a class="text-muted" href="forgot-password.php">Forgot password?</a></p>
                                            <p>Don't have an account? <a href="signup.php" class="link-info">Register here</a></p>
                                        </div>
                                    </form>

                                </div>
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
    public function signup($conf){
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <style>
                /* signup page: navy -> gold gradients and placeholder background */
                :root{
                    --navy: #0a2540;
                    --navy-dark: #071a30;
                    --gold: #D4AF37;
                    --gold-dark: #b98f2b;
                }
                .gradient-custom-3 {
                    background: linear-gradient(90deg, rgba(10,37,64,0.9) 0%, rgba(10,37,64,0.7) 100%);
                }
            </style>
        </head>
        <body>
        <section class="vh-100 bg-image"
                 style="background-image: url('https://strathmore.edu/wp-content/uploads/2023/12/Artboard-1.png');"
        >
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">

                                    <?php
                                    // Display general messages or validation errors
                                    if (isset($_SESSION['msg'])) {
                                        $msg_type = isset($_SESSION['msg_type']) ? $_SESSION['msg_type'] : 'danger';
                                        echo '<div class="alert alert-' . $msg_type . ' text-center">';
                                        echo $_SESSION['msg'];
                                        if (isset($_SESSION['errors'])) {
                                            echo '<ul class="list-unstyled mb-0 mt-2">';
                                            foreach ($_SESSION['errors'] as $error) {
                                                echo '<li>' . htmlspecialchars($error) . '</li>';
                                            }
                                            echo '</ul>';
                                        }
                                        echo '</div>';
                                        unset($_SESSION['msg']);
                                        unset($_SESSION['msg_type']);
                                        unset($_SESSION['errors']);
                                    }
                                    ?>

                                    <div class="text-center mb-4">
                                        <img src="assets/StrathEventique_Logo.png" alt="StrathEventique Logo" style="height: 80px;" class="me-3">
                                        <h2 class="text-uppercase text-center d-inline-block align-middle">StrathEventique</h2>
                                    </div>

                                    <h3 class="fw-normal mb-4 text-center" style="letter-spacing: 1px;">Create an Account</h3>

                                    <form method="post">
                                        <input type="hidden" name="signup" value="1">

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" name="fullname" class="form-control form-control-lg" required />
                                            <label class="form-label">Your Name</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" name="email" class="form-control form-control-lg" required />
                                            <label class="form-label">Your Email</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password" class="form-control form-control-lg" required />
                                            <label class="form-label">Password</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password_repeat" class="form-control form-control-lg" required />
                                            <label class="form-label">Repeat your password</label>
                                        </div>

                                        <div class="d-flex justify-content-center mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="terms_agree" id="terms_agree" required />
                                                <label class="form-check-label" for="terms_agree">
                                                    I agree to the <a href="#!" class="text-body"><u>Terms of service</u></a>
                                                </label>
                                            </div>
                                        </div>

                                        <button data-mdb-button-init data-mdb-ripple-init type="submit" class="btn btn-primary btn-lg mb-3" style="width: 100%;">Register</button>
                                    </form>

                                    <div class="text-center">
                                        <p class="mb-0">Already have an account? <a href="signin.php" class="link-info">Log in here</a></p>
                                    </div>

                                </div>
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
    public function verify($conf){
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <!-- ...existing code... -->
            <style>
                :root{
                  --navy: #0a2540;
                  --gold: #D4AF37;
                }
                .verification-container {
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: linear-gradient(135deg, var(--navy) 0%, #11263b 100%);
                    color: var(--gold);
                }
                .text-primary { color: var(--gold) !important; }
                .btn-primary { background-color: var(--navy) !important; color: var(--gold) !important; border-color: var(--navy) !important; }
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

    public function create_event_form($conf){
        ?>
        <div class="container" style="margin-top: 100px;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center mb-4">Create a New Event</h2>
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Event Title</label>
                                    <input type="text" name="event_title" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Event Description</label>
                                    <textarea name="event_description" class="form-control" rows="5" required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Date</label>
                                        <input type="date" name="event_date" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Time</label>
                                        <input type="time" name="event_time" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Location / Venue</label>
                                    <input type="text" name="event_location" class="form-control" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">Create Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function dashboard_view($conf, $events){
        ?>
        <div class="container" style="margin-top: 100px;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>My Dashboard</h1>
                <a href="create-event.php" class="btn btn-primary">Create New Event</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>My Created Events</h3>
                </div>
                <div class="card-body">
                    <?php if (count($events) > 0): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($events as $event): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5><?php echo htmlspecialchars($event['title']); ?></h5>
                                        <small class="text-muted">
                                            <?php echo date("F j, Y", strtotime($event['event_date'])); ?> at <?php echo htmlspecialchars($event['location']); ?>
                                        </small>
                                    </div>
                                    <div>
                                        <a href="edit-event.php?id=<?php echo $event['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                        <a href="delete-event.php?id=<?php echo $event['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-center">You haven't created any events yet. <a href="create-event.php">Get started!</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }

    public function forgot_password_form($conf) {
        ?>
        <section class="vh-100 bg-image" style="background-image: url('https://strathmore.edu/wp-content/uploads/2023/12/Artboard-1.png');">
            <div class="mask d-flex align-items-center h-100" style="background-color: rgba(10, 37, 64, 0.8);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <?php if(isset($_SESSION['msg'])) { /* ... message display code ... */ } ?>
                                    <h3 class="text-center mb-4">Forgot Your Password?</h3>
                                    <p class="text-muted text-center mb-4">Enter your email address and we will send you a link to reset your password.</p>
                                    <form method="post">
                                        <input type="hidden" name="forgot_password" value="1">
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" name="email" class="form-control form-control-lg" required />
                                            <label class="form-label">Email Address</label>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg">Send Reset Link</button>
                                        </div>
                                    </form>
                                    <div class="text-center mt-4">
                                        <a href="signin.php">Back to Sign In</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    public function reset_password_form($conf, $token) {
        ?>
        <section class="vh-100 bg-image" style="background-image: url('https://strathmore.edu/wp-content/uploads/2023/12/Artboard-1.png');">
            <div class="mask d-flex align-items-center h-100" style="background-color: rgba(10, 37, 64, 0.8);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">

                                    <?php
                                    // Display messages
                                    if (isset($_SESSION['msg'])) {
                                        $msg_type = isset($_SESSION['msg_type']) ? $_SESSION['msg_type'] : 'danger';
                                        echo '<div class="alert alert-' . $msg_type . ' text-center">';
                                        echo $_SESSION['msg'];
                                        echo '</div>';
                                        unset($_SESSION['msg']);
                                        unset($_SESSION['msg_type']);
                                    }
                                    ?>

                                    <h3 class="text-center mb-4">Reset Your Password</h3>
                                    <form method="post">
                                        <input type="hidden" name="reset_password" value="1">
                                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password" class="form-control form-control-lg" required />
                                            <label class="form-label">New Password</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password_repeat" class="form-control form-control-lg" required />
                                            <label class="form-label">Repeat New Password</label>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
    public function public_events_list($conf, $events) {
        ?>
        <div class="container" style="margin-top: 100px;">
            <div class="text-center mb-5">
                <h1>Upcoming Events</h1>
                <p class="lead text-muted">Discover the next big thing happening at Strathmore</p>
            </div>

            <div class="row">
                <?php if (count($events) > 0): ?>
                    <?php foreach ($events as $event): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img src="https://placehold.co/600x400/0a2540/D4AF37?text=<?php echo htmlspecialchars(str_replace(' ', '+', $event['title'])); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($event['title']); ?>">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?php echo htmlspecialchars($event['title']); ?></h5>
                                    <p class="card-text text-muted">
                                        <strong>Date:</strong> <?php echo date("D, M j, Y", strtotime($event['event_date'])); ?><br>
                                        <strong>Time:</strong> <?php echo date("g:i A", strtotime($event['event_time'])); ?><br>
                                        <strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?>
                                    </p>
                                    <p class="card-text flex-grow-1"><?php echo htmlspecialchars(substr($event['description'], 0, 100)) . '...'; ?></p>
                                    <a href="event-details.php?id=<?php echo $event['id']; ?>" class="btn btn-primary mt-auto">View Details</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-center text-muted">There are no upcoming events at the moment. Please check back soon!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
    public function event_details_view($conf, $event) {
        ?>
        <div class="container" style="margin-top: 100px;">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg">
                        <img src="https://placehold.co/800x400/0a2540/D4AF37?text=<?php echo htmlspecialchars(str_replace(' ', '+', $event['title'])); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($event['title']); ?>">
                        <div class="card-body p-5">
                            <h1 class="card-title mb-3"><?php echo htmlspecialchars($event['title']); ?></h1>

                            <div class="d-flex text-muted mb-4">
                                <div class="me-4">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    <?php echo date("l, F j, Y", strtotime($event['event_date'])); ?>
                                </div>
                                <div class="me-4">
                                    <i class="fas fa-clock me-2"></i>
                                    <?php echo date("g:i A", strtotime($event['event_time'])); ?>
                                </div>
                                <div>
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <?php echo htmlspecialchars($event['location']); ?>
                                </div>
                            </div>

                            <h4 class="mt-4">About this Event</h4>
                            <p class="card-text" style="white-space: pre-wrap;"><?php echo htmlspecialchars($event['description']); ?></p>

                            <div class="d-grid gap-2 mt-5">
                                <a href="#" class="btn btn-primary btn-lg">Register for this Event</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    public function edit_event_form($conf, $event) {
        ?>
        <div class="container" style="margin-top: 100px;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center mb-4">Edit Event</h2>
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Event Title</label>
                                    <input type="text" name="event_title" class="form-control" value="<?php echo htmlspecialchars($event['title']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Event Description</label>
                                    <textarea name="event_description" class="form-control" rows="5" required><?php echo htmlspecialchars($event['description']); ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Date</label>
                                        <input type="date" name="event_date" class="form-control" value="<?php echo htmlspecialchars($event['event_date']); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Time</label>
                                        <div class="form-outline" data-mdb-timepicker-init>
                                            <input type="text" name="event_time" class="form-control" id="timepicker" value="<?php echo htmlspecialchars($event['event_time']); ?>" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Location / Venue</label>
                                    <input type="text" name="event_location" class="form-control" value="<?php echo htmlspecialchars($event['location']); ?>" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    public function admin_users_list($conf, $users) {
        ?>
        <div class="container" style="margin-top: 100px;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>User Management</h1>
            </div>

            <?php
            // Display feedback messages
            if (isset($_SESSION['msg'])) {
                $msg_type = isset($_SESSION['msg_type']) ? $_SESSION['msg_type'] : 'info';
                echo '<div class="alert alert-' . $msg_type . '">' . $_SESSION['msg'] . '</div>';
                unset($_SESSION['msg']);
                unset($_SESSION['msg_type']);
            }
            ?>

            <div class="card">
                <div class="card-header">
                    <h3>All Registered Users</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th style="width: 200px;">Change Role</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo ($user['role'] === 'admin') ? 'primary' : 'secondary'; ?>">
                                            <?php echo htmlspecialchars($user['role']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" class="d-flex">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                            <input type="hidden" name="change_role" value="1">
                                            <select name="new_role" class="form-select form-select-sm me-2">
                                                <option value="user" <?php echo ($user['role'] === 'user') ? 'selected' : ''; ?>>User</option>
                                                <option value="admin" <?php echo ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

