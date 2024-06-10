<?php
include 'koneksi.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form action and user ID from the POST data
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING);

    // Initialize a variable for the SQL query
    $sql = "";

    // Determine the action to take (accept or reject)
    if ($action == 'accept') {
        // Begin a transaction
        $conn->begin_transaction();

        try {
            // Fetch the user data from the user_verif table
            $stmt = $conn->prepare("SELECT * FROM user_verif WHERE id = ?");
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user_data = $result->fetch_assoc();
            $stmt->close();

            if ($user_data) {
                // Insert the user data into the main users table
                $stmt = $conn->prepare("INSERT INTO users (id, username, phone, email) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $user_data['id'], $user_data['username'], $user_data['phone'], $user_data['email']);
                $stmt->execute();
                $stmt->close();

                // Remove the user data from the user_verif table
                $stmt = $conn->prepare("DELETE FROM user_verif WHERE id = ?");
                $stmt->bind_param("s", $user_id);
                $stmt->execute();
                $stmt->close();

                // Commit the transaction
                $conn->commit();
                // Redirect back to the verification page with a success message
                header("Location: verifikasi_admin.php?status=success");
                exit();
            } else {
                // User data not found, rollback transaction
                $conn->rollback();
                header("Location: verifikasi_admin.php?status=error_user_not_found");
                exit();
            }
        } catch (Exception $e) {
            // Roll back the transaction if an error occurs
            $conn->rollback();

            // Log error message (optional)
            error_log("Error in user verification process: " . $e->getMessage());

            // Redirect back to the verification page with an error message
            header("Location: verifikasi_admin.php?status=error");
            exit();
        }
    } elseif ($action == 'reject') {
        // Prepare and execute the SQL statement to delete the user data from the user_verif table
        $stmt = $conn->prepare("DELETE FROM user_verif WHERE id = ?");
        $stmt->bind_param("s", $user_id);
        if ($stmt->execute()) {
            // Redirect back to the verification page with a success message
            header("Location: verifikasi_admin.php?status=success");
            exit();
        } else {
            // Log error message (optional)
            error_log("Error deleting user from user_verif table: " . $stmt->error);

            // Redirect back to the verification page with an error message
            header("Location: verifikasi_admin.php?status=error");
            exit();
        }
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>
