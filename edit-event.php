<?php
require "ClassAutoLoad.php";

// Admin & security checks
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$event_id = $_GET['id'] ?? null;
if (!$event_id) {
    header("Location: dashboard.php");
    exit();
}

// Fetch the event to pre-fill the form
$event = $ObjDB->fetch("SELECT * FROM events WHERE id = ?", [$event_id]);
if (!$event) {
    // Event doesn't exist or doesn't belong to this user
    header("Location: dashboard.php");
    exit();
}

// Handle form submission for the update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // --- START: Image Upload Handling ---
        $image_path = null; // Default to null if no image is uploaded
        if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == 0) {
            $target_dir = "uploads/events/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true); // Create directory if it doesn't exist
            }
            $file_name = uniqid() . '-' . basename($_FILES["event_image"]["name"]);
            $target_file = $target_dir . $file_name;

            // Move the uploaded file to your server
            if (move_uploaded_file($_FILES["event_image"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
            }
        }


        $title = $_POST['event_title'];
        $description = $_POST['event_description'];
        $event_date = $_POST['event_date'];
        $event_time = $_POST['event_time'];
        $location = $_POST['event_location'];
    }

        // If a new image was successfully uploaded, include it in the update
        if ($image_path) {
            $ObjDB->query(
                "UPDATE events SET title = ?, description = ?, event_date = ?, event_time = ?, location = ?, image_path = ? WHERE id = ?",
                [$title, $description, $event_date, $event_time, $location, $image_path, $event_id]
            );
        } else {
            // If no new image was uploaded, update everything else
            $ObjDB->query(
                "UPDATE events SET title = ?, description = ?, event_date = ?, event_time = ?, location = ? WHERE id = ?",
                [$title, $description, $event_date, $event_time, $location, $event_id]
            );
        }

    $_SESSION['msg'] = 'Event updated successfully!';
    $_SESSION['msg_type'] = 'success';
    header("Location: dashboard.php");
    exit();
}

// Display the page
$ObjLayout->create_event_layout_header($conf); // Use the special header for MDB components
$ObjLayout->navbar($conf);
$ObjLayout->edit_event_form($conf, $event); // We'll create this new function next
$ObjLayout->create_event_layout_footer($conf); // Use the special footer
?>