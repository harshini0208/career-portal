<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "jobadmin";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection unsuccessful" . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST["title"];
    $experience = $_POST["experience"];
    $filename = $_FILES['file']['name'];
    $tempfilename = $_FILES['file']['tmp_name'];
    $folder = "uploads/" . $filename;

    $sql = "INSERT INTO jobadmin (title, experience) VALUES ('$title', '$experience')";

    if ($filename == "") {
        echo "<div class='alert alert-warning' role='alert'>Please upload a file</div>";
    } else {
        $filesplit = explode('.', $filename);
        $filext = strtolower(end($filesplit));
        $allowed = array('pdf');
        if (in_array($filext, $allowed)) {
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<div class='alert alert-success' role='alert'>CONGRATS! YOUR RESUME HAS BEEN SUBMITTED</div>";

                // Increment the applicants_count for the corresponding job title
                $sql_update_count = "UPDATE `jobadmin` SET `applicants_count` = `applicants_count` + 1 WHERE `title` = '$title'";
                $result_update_count = mysqli_query($conn, $sql_update_count);

                if (!$result_update_count) {
                    echo "Failed to update applicants count: " . mysqli_error($conn);
                }
            } else {
                echo "Not inserted: " . mysqli_error($conn);
            }
        } else {
            echo " <div class='alert alert-danger' role='alert'>Only PDF files are accepted</div>";
        }
    }
}
?>
