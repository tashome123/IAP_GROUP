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
                header("Location: index.php");
                exit();
            } else {
                // Login failed
                $ObjFncs->setMsg('msg', 'Invalid email or password, or account not verified.', 'danger');
            }
        }
    }
}