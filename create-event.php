<?php
require "ClassAutoLoad.php";

// Redirect user to signin page if they are not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_title = $_POST['event_title'];
    $event_desc = $_POST['event_description'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_location = $_POST['event_location'];
    $user_id = $_SESSION['user_id'];

    // --- START: CORRECTED CODE ---
    // Attempt to insert the event into the database
    try {
        // Attempt to insert the event into the database
        $result = $ObjDB->insert('events', [
            'user_id' => $user_id,
            'title' => $event_title,
            'description' => $event_desc,
            'event_date' => $event_date,
            'event_time' => $event_time,
            'location' => $event_location
        ]);

        if ($result) {
            // If successful, redirect to the dashboard with a success message
            $_SESSION['msg'] = 'Event created successfully!';
            $_SESSION['msg_type'] = 'success';
            header("Location: dashboard.php");
            exit();
        } else {
            // If the insert method returns false without an error
            throw new Exception("The event could not be saved for an unknown reason.");
        }

    } catch (Exception $e) {
        // If any error occurs, stay on the page and display the error
        $_SESSION['msg'] = 'Error creating event: ' . $e->getMessage();
        $_SESSION['msg_type'] = 'danger';
        // We don't redirect here, so the user sees the error on the create page
    }
    // --- END: CORRECTED CODE ---
}

// Display the page layout
$ObjLayout->create_event_layout_header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->create_event_form($conf);
$ObjLayout->create_event_layout_footer($conf);
?>