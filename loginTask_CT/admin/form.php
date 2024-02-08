<?php
include('database2.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/form.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="assets/js/login.js"></script>
    <title>user form</title>
</head>
<body>
<?php
    $sql = "SELECT * FROM user_data ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <form  method="post" action="#" enctype="multipart/form-data">
       <label for="heading">add heading:<br>
        <input type="text" class="heading" required value="<?php echo $row['headings']; ?>"><br>
        <label for="para">add paragraph:<br>
        <input type="text" class="para" required value="<?php echo $row['texts']; ?>"><br>
        <input type="file" name="upload_file" id="upload_file" required ><br>
        <input type="submit" class="add_data">
</form>
<script>
        // JavaScript function to display the file name in the file input field
        function showFileName(input) {
            if (input.files.length > 0) {
                var fileName = input.files[0].name;
                input.nextElementSibling.innerHTML = fileName;
            } else {
                // If no file is chosen, set the file name to the last uploaded file
                var lastUploadedFileName = '<?php echo $row['images']; ?>';
                if (lastUploadedFileName !== '') {
                    input.nextElementSibling.innerHTML = lastUploadedFileName;
                }
            }
        }
    </script>

</body>
</html>