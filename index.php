<?php
$servername="localhost";
$username="root";
$password="";
$database="notes";

$conn=mysqli_connect($servername,$username,$password,$database);


if(!$conn)
{
    die("connection unsuccessful".mysqli_connect_error());
}

//DELETE
if(isset($_GET['delete']))
{
  $slno=$_GET['delete'];
  $sql="DELETE FROM `mynote` WHERE `slno` = $slno";
  $result=mysqli_query($conn,$sql);
}

//EDIT
if($_SERVER['REQUEST_METHOD']=='POST')
{
  if(isset($_POST['slnoedit']))
  {
    $slno=$_POST['slnoedit'];
    $title=$_POST['titleedit'];  
    $description=$_POST['descriptionedit'];
 

  
  $sql="UPDATE `mynote` SET `title` = '$title',`description` = '$description' WHERE `mynote`.`slno` = $slno";
  $result= mysqli_query($conn,$sql);

  }
  else
  {
  $title=$_POST['title'];
  session_start();
  $description=$_POST['description'];
  $_SESSION['description'] = $description;
  
  $sql="INSERT INTO `mynote` (`title`, `description`) VALUES ( '$title', '$description')";
  $result= mysqli_query($conn,$sql);

  if(!$result)
  {
      die("adding note unsuccessful");
  }
}
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
  <title>MyNotes</title>

  </head>
  
  <body>

 

<!-- Edit modal -->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
Edit Modal
</button>-->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <form action="/crud/index.php" method="post">
        <input type="hidden" name="slnoedit" id="slnoedit">
  <div class="form-group">
    <label for="title">NOTE EDIT</label>
    <input type="text" class="form-control" name="titleedit" id="titleedit" aria-describedby="emailHelp" placeholder="">
  </div>
  
  <div class="form-group">
    <label for="description">NOTE DESCRIPTION</label>
    <textarea class="form-control" name="descriptionedit" id="descriptionedit" rows="10" cols="10"></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Update Note</button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">EDIT</button>
      </div>
    </div>
  </div>
</div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">NOTES</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<div class="container">
<form action="/crud/index.php" method="post">
  <div class="form-group">
    <label for="title">NOTE TITLE</label>
    <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp" placeholder="">
  </div>
  
  <div class="form-group">
    <label for="description">NOTE DESCRIPTION</label>
    <textarea class="form-control" name="description" id="description" rows="10" cols="10"></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Add Note</button>
</form>
</div>


<div class="container">

<table class="table" id='myTable'>
  <thead>
    <tr>
      <th scope="col">sl no.</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>    
  <body>
  <?php
$sql="SELECT * FROM `mynote` WHERE 1";
$result=mysqli_query($conn,$sql);

$slno=0;
while($row=mysqli_fetch_assoc($result))
{
  $slno=$slno+1;
  
    echo "<tr>
    <th scope='row'>".$slno."</th>
    <td>".$row['title']."</td>
    <td>".$row['description']."</td>
    <td> <button class='edit btn btn-sm btn-primary' id=".$row['slno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['slno'].">Delete</button> <button class='apply btn btn-sm btn-light' id=a".$row['slno']."><a href='upload.php'>Apply</a></button> </td>
  </tr>";

}
?>
    
  </body>
</table>
</div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    
  <script>
    edits= document.getElementsByClassName('edit');
    Array.from(edits).forEach((element)=>{
      element.addEventListener("click",(e)=>{
        console.log("edit");
        tr=e.target.parentNode.parentNode;
        title=tr.getElementsByTagName("td")[0].innerText;
        description=tr.getElementsByTagName("td")[1].innerText;
        console.log(title,description);
        titleedit.value=title;
        descriptionedit.value=description;
        slnoedit.value=e.target.id;
        $('#editModal').modal('toggle');
      })
    })

    deletes= document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element)=>{
      element.addEventListener("click",(e)=>{
        console.log("delete", );
        slno=e.target.id.substr(1,);

        if(confirm("confirm delete"))
        {
          console.log("yes");
          window.location=`/crud/index.php?delete=${slno}`;
        }
        else
        {
          console.log("no");
        }
      })
    })

    

    

  </script>
  
    
  </body>
</html>