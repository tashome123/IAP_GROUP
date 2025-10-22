<?php
require "ClassAutoLoad.php";

// IMPORTANT: Add security check - only admins should run this!
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    // You could redirect or show an error
    die("Access Denied: Admin privileges required.");
}

$response = ['status' => 'error', 'message' => 'Invalid request.'];
$scannedData = $_GET['data'] ?? null; // Assume data comes from URL parameter ?data=...

if ($scannedData && strpos($scannedData, 'RegID:') === 0) {
    $registrationId = substr($scannedData, 6); // Extract the ID after "RegID:"

    if (is_numeric($registrationId)) {
        // Fetch the registration, including event details for display
        $registration = $ObjDB->fetch(
            "SELECT er.id, er.checked_in_at, e.title as event_title, u.fullname as user_name 
             FROM event_registrations er
             JOIN events e ON er.event_id = e.id
             JOIN users u ON er.user_id = u.id
             WHERE er.id = ?",
            [$registrationId]
        );

        if ($registration) {
            if ($registration['checked_in_at'] === null) {
                // Ticket is valid and not yet checked in - Mark it as checked in NOW
                $checkinTime = date("Y-m-d H:i:s");
                $ObjDB->query(
                    "UPDATE event_registrations SET checked_in_at = ? WHERE id = ?",
                    [$checkinTime, $registrationId]
                );
                $response = [
                    'status' => 'success',
                    'message' => 'Check-in successful!',
                    'user' => $registration['user_name'],
                    'event' => $registration['event_title'],
                    'time' => $checkinTime
                ];
            } else {
                // Ticket has already been checked in
                $response = [
                    'status' => 'warning',
                    'message' => 'This ticket has already been checked in.',
                    'user' => $registration['user_name'],
                    'event' => $registration['event_title'],
                    'time' => $registration['checked_in_at']
                ];
            }
        } else {
            // Registration ID not found in the database
            $response = ['status' => 'error', 'message' => 'Invalid Ticket: Registration not found.'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Invalid Ticket Data Format.'];
    }
} else {
    $response = ['status' => 'error', 'message' => 'No ticket data provided or invalid format.'];
}

// Display results (simple HTML version)
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ticket Scan Result</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 40px; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-warning { background-color: #fff3cd; color: #856404; }
        .alert-danger { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
<div class="container">
    <h1>Scan Result</h1>
    <div class="alert
            <?php echo ($response['status'] === 'success') ? 'alert-success' : (($response['status'] === 'warning') ? 'alert-warning' : 'alert-danger'); ?>"
         role="alert">
        <h4 class="alert-heading"><?php echo htmlspecialchars(ucfirst($response['status'])); ?>!</h4>
        <p><?php echo htmlspecialchars($response['message']); ?></p>
        <?php if (isset($response['user'])): ?>
            <hr>
            <p class="mb-0"><strong>User:</strong> <?php echo htmlspecialchars($response['user']); ?></p>
            <p class="mb-0"><strong>Event:</strong> <?php echo htmlspecialchars($response['event']); ?></p>
            <?php if (isset($response['time'])): ?>
                <p class="mb-0"><strong>Time:</strong> <?php echo htmlspecialchars($response['time']); ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>
</body>
</html>