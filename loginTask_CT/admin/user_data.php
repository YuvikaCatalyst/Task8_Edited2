<?php

include('database2.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_heading = $_POST['form_heading'];
    $form_text = $_POST['form_text'];

    $file_name = '';
    if (isset($_FILES['upload_file'])) {
        $file_name = $_FILES['upload_file']['name'];
        $file_tmp = $_FILES['upload_file']['tmp_name'];
        move_uploaded_file($file_tmp, "assets/uploads/" . $file_name);
    }

    // Check if there's an existing record with any matching fields
    $sql = "SELECT * FROM user_data WHERE headings = '$form_heading' OR texts = '$form_text'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Update the existing record
        if (!empty($file_name)) {
            $update_sql = "UPDATE user_data SET headings = '$form_heading', texts = '$form_text', images = '$file_name'";
        } else {
            $update_sql = "UPDATE user_data SET headings = '$form_heading', texts = '$form_text'";
        }

        if (mysqli_query($conn, $update_sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

    } else {
        // Check if there's already a record in the table
        $existing_records = mysqli_query($conn, "SELECT * FROM user_data");
        if (mysqli_num_rows($existing_records) > 0) {
            $update_sql = "UPDATE user_data SET headings = '$form_heading', texts = '$form_text', images = '$file_name'";
            if (mysqli_query($conn, $update_sql)) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            // Insert a new record if no record exists
            $insert_sql = "INSERT INTO user_data (headings, texts, images) VALUES ('$form_heading', '$form_text', '$file_name')";
            if (mysqli_query($conn, $insert_sql)) {
                echo "Record created successfully";
            } else {
                echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}
?>































