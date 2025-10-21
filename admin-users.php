<?php
require "ClassAutoLoad.php";
// Admin security check
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Admin security check
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Handle a role change request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_role'])) {
    $user_id_to_change = $_POST['user_id'];
    $new_role = $_POST['new_role'];

    // You can add more validation here (e.g., ensure 'new_role' is a valid role)

    // Update the user's role in the database
    $ObjDB->query("UPDATE users SET role = ? WHERE id = ?", [$new_role, $user_id_to_change]);

    $_SESSION['msg'] = 'User role updated successfully.';
    $_SESSION['msg_type'] = 'success';
    header("Location: admin-users.php");
    exit();
}


// Fetch all users from the database, ordered by registration date
$all_users = $ObjDB->fetchAll("SELECT id, fullname, email, role FROM users ORDER BY id ASC");

// Display the page
$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->admin_users_list($conf, $all_users); // We'll create this function next
$ObjLayout->footer($conf);

?>