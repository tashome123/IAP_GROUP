<?php
class autho{

    // Method to bind email template variables
    public function bindEmailTemplate($template, $variables) {
        foreach ($variables as $key => $value) {
            $template = str_replace("{{" . $key . "}}", $value, $template);
        }
        return $template;
    }

    public function signup($conf, $ObjFncs, $lang, $ObjSendMail, $ObjDB)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {

            $errors = array();

            $fullname = $_SESSION['fullname'] = ucwords(strtolower($_POST['fullname']));
            $email = $_SESSION['email'] = strtolower($_POST['email']);
            $password = $_SESSION['password'] = $_POST['password'];

            // Simple validation (you can expand this as needed)

            // Verify fullname
            if (empty($fullname) || !preg_match("/^[a-zA-Z ]*$/", $fullname)) {
                $errors['fullname_error'] = "Only letters and white space allowed in fullname";
            }

            // Verify email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['mailFormat_error'] = "Invalid email format";
            }

            // Check if email already exists
            $existing_user = $ObjDB->fetch("SELECT id FROM users WHERE email = ?", [$email]);
            if ($existing_user) {
                $errors['email_exists'] = "An account with this email already exists";
            }

            // Verify if the email domain is valid
            $email_domain = substr(strrchr($email, "@"), 1);
            if (!in_array($email_domain, $conf['valid_email_domain'])) {
                $errors['mailDomain_error'] = "Email domain must be one of the following: " . implode(", ", $conf['valid_email_domain']);
            }
            // Verify password length
            if (strlen($password) < $conf['min_password_length']) {
                $errors['password_error'] = "Password must be at least " . $conf['min_password_length'] . " characters long";
            }

            // Check if passwords match
            $password_repeat = $_POST['password_repeat'];
            if ($password !== $password_repeat) {
                $errors['password_match_error'] = "Passwords do not match";
            }

            // If there are errors, display them
            if (!count($errors)) {

                if (!count($errors)) {
                    $verification_code = sprintf("%06d", mt_rand(1, 999999));
                    $_SESSION['verification_code'] = $verification_code;
                    $_SESSION['verification_email'] = $email;
                    $_SESSION['pending_fullname'] = $fullname;
                    $_SESSION['pending_password'] = password_hash($password, PASSWORD_DEFAULT);

                    $email_variables = [
                        'site_name' => $conf['site_name'],
                        'fullname' => $fullname,
                        'activation_code' => $verification_code
                    ];
                    $mailCnt = [
                        'name_from' => $conf['site_name'],
                        'mail_from' => $conf['admin_email'],
                        'name_to' => $fullname,
                        'mail_to' => $email,
                        'subject' => $this->bindEmailTemplate($lang["ver_reg_subj"], $email_variables),
                        'body' => nl2br($this->bindEmailTemplate($lang["ver_reg_body"], $email_variables))
                    ];

                    // Send the email
                    $result = $ObjSendMail->Send_Mail($conf, $mailCnt);

                    if ($result) {
                        header("Location: verify.php");
                        exit();
                    } else {
                        $errors['mail_error'] = "Failed to send verification email";
                        $ObjFncs->setMsg('errors', $errors, 'danger');
                        $ObjFncs->setMsg('msg', 'Please fix the errors below and try again.', 'danger');
                    }
                } else {
                    $ObjFncs->setMsg('errors', $errors, 'danger');
                    $ObjFncs->setMsg('msg', 'Please fix the errors below and try again.', 'danger');
                }
            }
        }
    }

    public function verifyAccount($conf, $ObjFncs, $lang, $ObjSendMail, $ObjDB) {
        // Handle resend request
        if(isset($_GET['resend']) && isset($_SESSION['verification_email'])) {
            // Generate new code
            $verification_code = sprintf("%06d", mt_rand(1, 999999));
            $_SESSION['verification_code'] = $verification_code;
            
            // Resend email (you'll need to implement this)
            $ObjFncs->setMsg('msg', 'A new verification code has been sent to your email.', 'info');
            header("Location: verify.php");
            exit();
        }

        // Handle verification submission
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify_account'])){
            $entered_code = $_POST['verification_code'];

            if(!isset($_SESSION['verification_code']) || !isset($_SESSION['verification_email'])) {
                $ObjFncs->setMsg('msg', 'Verification session expired. Please sign up again.', 'danger');
                header("Location: signup.php");
                exit();
            }

            if($entered_code == $_SESSION['verification_code']) {

                $email_variables = [
                    'site_name' => $conf['site_name'],
                    'fullname' => $_SESSION['pending_fullname'],
                    'activation_code' => $verification_code
                ];

                $mailCnt = [
                    'name_from' => $conf['site_name'],
                    'mail_from' => $conf['admin_email'],
                    'name_to' => $_SESSION['pending_fullname'],
                    'mail_to' => $_SESSION['verification_email'],
                    'subject' => $this->bindEmailTemplate($lang["ver_reg_subj"], $email_variables),
                    'body' => nl2br($this->bindEmailTemplate($lang["ver_reg_body"], $email_variables))
                ];

                $ObjSendMail->Send_Mail($conf, $mailCnt);
                
                $email = $_SESSION['verification_email'];
                $fullname = $_SESSION['pending_fullname'];
                $password_hash = $_SESSION['pending_password'];

                // Insert user into database
                $result = $ObjDB->insert('users', [
                    'email' => $email,
                    'fullname' => $fullname,
                    'password' => $password_hash,
                    'verified' => 1
                ]);

                if($result) {
                    // Clear session variables
                    unset($_SESSION['verification_code']);
                    unset($_SESSION['verification_email']);
                    unset($_SESSION['pending_fullname']);
                    unset($_SESSION['pending_password']);
                    unset($_SESSION['fullname']);
                    unset($_SESSION['email']);
                    unset($_SESSION['password']);

                    // Success message
                    $_SESSION['msg'] = 'Account verified successfully! You can now sign in.';
                    $_SESSION['msg_type'] = 'success';
                    header("Location: signin.php");
                    exit();
                } else {
                    $ObjFncs->setMsg('msg', 'Error creating account. Please try again.', 'danger');
                }
            } else {
                $ObjFncs->setMsg('msg', 'Invalid verification code. Please try again.', 'danger');
            }
        }
    }

    public function signin($conf, $ObjFncs, $ObjDB) {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signin'])){
            $email = strtolower($_POST['email']);
            $password = $_POST['password'];

            // Query database for user
            $user = $ObjDB->fetch("SELECT * FROM users WHERE email = ? AND verified = 1", [$email]);
            
            if($user && password_verify($password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['fullname'];
                $_SESSION['user_role'] = $user['role'];
                header("Location: index.php");
                exit();
            } else {
                // Login failed
                $ObjFncs->setMsg('msg', 'Invalid email or password, or account not verified.', 'danger');
            }
        }
    }

    public function forgotPassword($conf, $ObjFncs, $lang, $ObjSendMail, $ObjDB) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['forgot_password'])) {
            $email = strtolower($_POST['email']);
            $user = $ObjDB->fetch("SELECT id, fullname FROM users WHERE email = ?", [$email]);

            if ($user) {
                // Generate a secure, random token
                $token = bin2hex(random_bytes(32));
                $expires = date("Y-m-d H:i:s", time() + 3600); // Token expires in 1 hour

                // Store the token and expiry in the database
                $ObjDB->query("UPDATE users SET reset_token = ?, reset_token_expires_at = ? WHERE id = ?", [$token, $expires, $user['id']]);

                // Create the reset link
                $reset_link = $conf['site_url'] . '/reset-password.php?token=' . $token;

                // Send the email
                $email_variables = [
                    'site_name' => $conf['site_name'],
                    'fullname' => $user['fullname'],
                    'reset_link' => $reset_link
                ];
                $mailCnt = [
                    'name_from' => $conf['site_name'],
                    'mail_from' => $conf['admin_email'],
                    'name_to' => $user['fullname'],
                    'mail_to' => $email,
                    'subject' => $this->bindEmailTemplate($lang["pass_reset_subj"], $email_variables),
                    'body' => $this->bindEmailTemplate($lang["pass_reset_body"], $email_variables)
                ];
                $ObjSendMail->Send_Mail($conf, $mailCnt);
            }

            // Always show a generic success message to prevent user enumeration
            $_SESSION['msg'] = 'If an account with that email exists, a password reset link has been sent.';
            $_SESSION['msg_type'] = 'success';
            header("Location: forgot-password.php");
            exit();
        }
    }

    public function resetPassword($conf, $ObjFncs, $ObjDB) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_password'])) {
            $token = $_POST['token'];
            $password = $_POST['password'];
            $password_repeat = $_POST['password_repeat'];

            // Validate token
            $user = $ObjDB->fetch("SELECT id FROM users WHERE reset_token = ? AND reset_token_expires_at > NOW()", [$token]);

            if (!$user) {
                $_SESSION['msg'] = 'Invalid or expired password reset link.';
                $_SESSION['msg_type'] = 'danger';
                header("Location: signin.php");
                exit();
            }

            // Validate passwords
            if (strlen($password) < $conf['min_password_length'] || $password !== $password_repeat) {
                $_SESSION['msg'] = 'Passwords must match and be at least ' . $conf['min_password_length'] . ' characters long.';
                $_SESSION['msg_type'] = 'danger';
                header("Location: reset-password.php?token=" . $token);
                exit();
            }

            // Update the password and invalidate the token
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $ObjDB->query("UPDATE users SET password = ?, reset_token = NULL, reset_token_expires_at = NULL WHERE id = ?", [$password_hash, $user['id']]);

            $_SESSION['msg'] = 'Your password has been reset successfully. You can now sign in.';
            $_SESSION['msg_type'] = 'success';
            header("Location: signin.php");
            exit();
        }
    }
}