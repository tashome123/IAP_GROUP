<?php
require "ClassAutoLoad.php";

// Admin security check
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// --- HANDLE ROLE CHANGE REQUEST ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_role'])) {
    $user_id_to_change = $_POST['user_id'];
    $new_role = $_POST['new_role'];

    // Prevent an admin from demoting themselves
    if (isset($_SESSION['user_id']) && $user_id_to_change == $_SESSION['user_id'] && $new_role !== 'admin') {
        $_SESSION['msg'] = 'You cannot demote your own admin account.';
        $_SESSION['msg_type'] = 'danger';
    } else {
        // Update the user's role in the database
        $ObjDB->query("UPDATE users SET role = ? WHERE id = ?", [$new_role, $user_id_to_change]);

        $_SESSION['msg'] = 'User role updated successfully.';
        $_SESSION['msg_type'] = 'success';
    }
    header("Location: admin-users.php");
    exit();
}

// --- ADDED: HANDLE USER DELETION REQUEST ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $user_id_to_delete = $_POST['user_id'];

    // Prevent an admin from deleting themselves
    if (isset($_SESSION['user_id']) && $user_id_to_delete == $_SESSION['user_id']) {
        $_SESSION['msg'] = 'You cannot delete your own admin account.';
        $_SESSION['msg_type'] = 'danger';
    } else {
        // Delete the user from the database
        $ObjDB->query("DELETE FROM users WHERE id = ?", [$user_id_to_delete]);

        $_SESSION['msg'] = 'User deleted successfully.';
        $_SESSION['msg_type'] = 'success';
    }
    header("Location: admin-users.php");
    exit();
}


// Fetch all users from the database, ordered by registration date
$all_users = $ObjDB->fetchAll("SELECT id, fullname, email, role FROM users ORDER BY id ASC");

// Display the page
$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->admin_users_list($conf, $all_users);
$ObjLayout->footer($conf);

?>