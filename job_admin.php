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
    
    

    if(isset($_GET['delete'])){
      $sno = $_GET['delete'];
      $delete = true;
      $sql ="DELETE FROM `jobadmin` WHERE `sno` = $sno";
      $result = mysqli_query($conn, $sql);
    }    

    if($_SERVER['REQUEST_METHOD']=='POST'){
      if(isset( $_POST['snoEdit'])){
        //update
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $experience = $_POST["experienceEdit"];
        $description = $_POST["descriptionEdit"];
        
        $sql = "UPDATE `jobadmin` SET `title` = '$title' , `experience` = '$experience',`description`='$description' WHERE `jobadmin`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
          $update = true;
        }
        else
        {
          echo "We could not update the record successfully";
        }
    }
      else
      {
        $title = $_POST["title"];
$experience = $_POST["experience"];
$description = $_POST["description"];
$sql = "INSERT INTO `jobadmin` (`title`, `experience`, `description`) VALUES ('$title', '$experience', '$description')";

        $result= mysqli_query($conn, $sql);

        if($result)
        {
          $insert = true;
        }
        else
        {
          echo "not inserted".mysqli_error($conn);
        }
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

    <title>ADMIN PORTAL</title>
    
    <meta charset="utf-8">

  </head>
  <body>
  <!-- Edit modal -->
 <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role=" dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit Record</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/crud/job_admin.php" method="POST">
        <input type="hidden" name="snoEdit" id="snoEdit">
  
  <div class="mb-3">
    <label for="title" class="form-label">Job Title</label>
    <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="experience" class="form-label">Experience</label>
    <input type="text" class="form-control" id="experienceEdit" name="experienceEdit" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="experience" class="form-label">Description</label>
    <input type="text" class="form-control" id="descriptionEdit" name="descriptionEdit" aria-describedby="emailHelp">
  </div>

  <button type="submit" class="edit btn btn-sm btn-primary">Edit</button>
</form>
      </div>
    </div>
  </div>
</div>

  
<?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>!</strong> New job has been added.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
?>
<?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>!</strong> Record has been deleted.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
?>
<?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>!</strong> Record has been updated.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
?>
 <div class="container my-4">
    <h3><u>Add Job</u></h3>
    <form action="/crud/job_admin.php" method="POST">
  <div class="mb-3">
    <label for="title" class="form-label">Job Title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="experience" class="form-label">Experience</label>
    <input type="text" class="form-control" id="experience" name="experience" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <input type="text" class="form-control" id="description" name="description" aria-describedby="emailHelp">
  </div>

  <button type="submit" class="btn btn-primary">Add job</button>
</form>


 </div>

 <div class="container">

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">SL NO.</th>
      <th scope="col">Jobs Available</th>
      <th scope="col">Experience</th>
      <th scope="col">Description</th>
      <th scope="col">Edit/Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php

$sql="SELECT * FROM `jobadmin`";
$result=mysqli_query($conn,$sql);
$sno=0;
while($row= mysqli_fetch_assoc($result))
{
  $sno=$sno+1;

 

  echo "<tr>
  <th scope='row'>".$sno."</th>
  <td>".$row['title']."</td>
  <td>".$row['experience']."</td>
  <td>".$row['description']."</td>
  

  <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button></td>  
  </tr>";
}
?>
  </tbody> 
</table>
 </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    -->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <div class="center">
    <table id="example" class="display" style="width:100%">
    

    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
    let table = new DataTable('#myTable');
    
    </script>
    </table>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const myTable = document.getElementById('myTable');

    myTable.addEventListener("click", function (e) {
        if (e.target.classList.contains('edit')) {
            const row = e.target.closest('tr');
            const cells = row.getElementsByTagName("td");

            // Adjust the indices based on the actual order of columns in your table
            const title = cells[0].innerText;
            const experience = cells[1].innerText;
            const description = cells[2].innerText;

            document.getElementById('snoEdit').value = e.target.id;
            document.getElementById('titleEdit').value = title;
            document.getElementById('experienceEdit').value = experience;
            document.getElementById('descriptionEdit').value = description;

            $('#editModal').modal('toggle');
        }

        if (e.target.classList.contains('delete')) {
            const sno = e.target.id.substr(1);
            if (confirm("Are you sure you want to delete the job?")) {
                window.location = `/crud/job_admin.php?delete=${sno}`;
            }
        }
    });
});


</script>

  </body>
</html>