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
      $id = $_GET['delete'];
      $delete = true;
      $sql ="DELETE FROM `employee` WHERE `id` = $id";
      $result = mysqli_query($conn, $sql);
    }    

    if($_SERVER['REQUEST_METHOD']=='POST'){
      if(isset( $_POST['idEdit'])){
        //update
        $id = $_POST['idEdit'];  // Capture the ID from the form
        $name = $_POST["nameEdit"];
        $department = $_POST["departmentEdit"];
        $position = $_POST["positionEdit"];
        $salary = $_POST["salaryEdit"];
        
        $sql = "UPDATE `employee` SET `name` = '$name' , `department` = '$department',`position`='$position',`salary`='$salary' WHERE `employee`.`id` = $id";
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
$name = $_POST["name"];
$department = $_POST["department"];
$position = $_POST["position"];
$salary = $_POST["salary"];

$sql = "INSERT INTO `employee` (`name`, `department`, `position`,`salary`) VALUES ('$name', '$department', '$position','$salary')";

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

    <title>EMPLOYEE PORTAL</title>
    
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
      <form action="/crud/employee.php" method="POST">
      <input type="hidden" name="idEdit" id="idEdit">

  <div class="mb-3">
    <label for="name" class="form-label">NAME</label>
    <input type="text" class="form-control" id="nameEdit" name="nameEdit" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="department" class="form-label">DEPARTMENT</label>
    <input type="text" class="form-control" id="departmentEdit" name="departmentEdit" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="position" class="form-label">POSITION</label>
    <input type="text" class="form-control" id="positionEdit" name="positionEdit" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="salary" class="form-label">SALARY</label>
    <input type="text" class="form-control" id="salaryEdit" name="salaryEdit" aria-describedby="emailHelp">
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
    <form action="/crud/employee.php" method="POST">
    
  <div class="mb-3">
    <label for="name" class="form-label">NAME</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="department" class="form-label">DEPARTMENT</label>
    <input type="text" class="form-control" id="department" name="department" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="position" class="form-label">POSITION</label>
    <input type="text" class="form-control" id="position" name="position" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="salary" class="form-label">SALARY</label>
    <input type="text" class="form-control" id="salary" name="salary" aria-describedby="emailHelp">
  </div>

  <button type="submit" class="btn btn-primary">Add job</button>
</form>


 </div>

 <div class="container">

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">DEPARTMENT</th>
      <th scope="col">POSITION</th>
      <th scope="col">SALARY</th>
      <th scope="col">Edit/Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php

$sql="SELECT * FROM `employee`";
$result=mysqli_query($conn,$sql);
$id=0;
while($row= mysqli_fetch_assoc($result))
{
  $id=$id+1;

 

  echo "<tr>
    <th scope='row'>".$id."</th>
    <td>".$row['name']."</td>
    <td>".$row['department']."</td>
    <td>".$row['position']."</td>
    <td>".$row['salary']."</td>
    <td> 
        <button class='edit btn btn-sm btn-primary' data-id='".$row['id']."'>Edit</button> 
        <button class='delete btn btn-sm btn-primary' data-id='".$row['id']."'>Delete</button> 
    </td>
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
    $(document).ready(function () {
    $('#myTable').DataTable();
});
    
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

            const name = cells[0].innerText;
            const department = cells[1].innerText;
            const position = cells[2].innerText;
            const salary = cells[3].innerText;

            console.log("Edit button clicked!");
            console.log("Name:", name);
            console.log("Department:", department);
            console.log("Position:", position);
            console.log("Salary:", salary);

            document.getElementById('idEdit').value = e.target.dataset.id;
            document.getElementById('nameEdit').value = name;
            document.getElementById('departmentEdit').value = department;
            document.getElementById('positionEdit').value = position;
            document.getElementById('salaryEdit').value = salary;

            $('#editModal').modal('toggle');
        }
        if (e.target.classList.contains('delete')) {
          const id = e.target.dataset.id;

          if (confirm("Are you sure you want to delete the job?")) {
                window.location = `/crud/employee.php?delete=${id}`;
            }
        }
    });
});

</script>

  </body>
</html>