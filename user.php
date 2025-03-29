<?php
    $insert = false;
    $update = false;
    $delete = false;
    
    $servername="localhost";
    $username="root";
    $password="";
    $database="jobadmin";

    $conn=mysqli_connect($servername,$username,$password,$database);
    if(!$conn)
    {
        die("connection failed".mysqli_connect(error));
    }
    /*else{
        echo "connection succesful";
    }*/ 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name= $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
    
        $sql = "INSERT INTO `user` (`name`, `phone`, `email`) VALUES ('$name', '$phone', '$email')";
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            $insert = true;
        } else {
            echo "Not inserted: " . mysqli_error($conn);
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://code.jquery.com/jquery-3.7.1.js' integrity='sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=' crossorigin='anonymous'></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
     
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src='https://code.jquery.com/jquery-3.7.1.js' integrity='sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=' crossorigin='anonymous'></script>
    <style>
        body {
            background-color: #ffc0cb;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .navbar {
            background-color: #212529;
            padding: 10px 0;
        }
        .navbar-brand img {
            width: 30px;
            height: auto;
            margin-right: 10px;
        }
        .navbar-dark .navbar-toggler-icon {
            background-color: #ffffff;
        }
        #myTable {
            width: 100%;
        }
        th, td {
            text-align: center;
        }
        .btn-edit, .btn-delete {
            padding: 5px 10px;
            margin-right: 5px;
        }
        .btn-edit {
            background-color: #007bff;
            color: #fff;
        }
        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }
    </style>

    <title>USER DETAILS PORTAL</title>
    
    <meta charset="utf-8">

  </head>
  <body>
  <!-- Edit modal -->
 <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- Modal -->
  
<?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>!</strong>WE HAVE RECIEVED YOUR DETAILS!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
?>

 <div class="container my-4">
    <h3><u>ENTER YOUR DEATILS</u></h3>
    <form action="/crud/user.php" method="POST">
  <div class="mb-3">
    <label for="name" class="form-label">ENTER YOUR NAME</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">ENTER YOU PHONE</label>
    <input type="text" class="form-control" id="phone" name="phone" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">ENTER YOUR EMAIL</label>
    <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
  </div>

  <button type="submit" class="btn btn-primary" id="submitBtn">SUBMIT</button>

</form>
</div>
<!-- Your HTML code with the button -->
<button type="button" class="btn btn-primary" id="viewJobsBtn">VIEW AVAILABLE JOBS</button>

<!-- JavaScript code to handle the button click and redirect -->
<script>
    document.getElementById("viewJobsBtn").addEventListener("click", function() {
        // Redirect to another page
        window.location.href = "job_user1.php";
    });
</script>


  </body>
</html>







