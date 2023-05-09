<?php
$insert = false;
$update = false;
$delete = false;

// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
  $SrNo = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `SrNo` = $SrNo";
  $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_GET['SrNoEdit'])) {
    echo "yes";
    // Update the record
    $SrNo = $_POST["SrNoEdit"];
    $title = $_POST["titleEdit"];
    $discription = $_POST["discriptionEdit"];
  
  // SQL query to be executed
  $sql = "UPDATE `notes` SET `Title` = '$title', `Discription` = '$discription' WHERE `notes`.`Sr.No.` = '$SrNo";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $update = true;
} else {
    echo "We could not update the record successfully";
}
  } else {
  $title = $_POST["title"];
  $discription = $_POST["discription"];
  
  // SQL query to be executed
  $sql = "INSERT INTO `notes` (`title`, `discription`) VALUES ('$title', '$discription')";
  $result = mysqli_query($conn, $sql);
  // Add a new trip to the Trip table in the database
  if ($result) {
      echo "The record has been inserted successfully!";
      $insert = true;
  } else {
      echo "The record was not inserted successfully because of this eroor ---> " . mysqli_error($conn);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  
    
    <title>iNotes - Notes taking made easy</title>
  </head>
  <body>

  <!-- Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModel">
Edit Model
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="editModelLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModelLabel">Edit this note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/PHP_CRUD_Operations/Index.php" method="post">
      <div class="modal-body">
        <input type="hidden" name="SrNoEdit" id="SrNoEdi">
          <div class="mb-3">
            <label for="title" class="form-label">Note Title</label>
            <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
          <div class="mb-3">
            <label for="desc" class="form-label">Note Discription</label>
            <textarea class="form-control" id="descsiptionEdit" name="descsiptionEdit" rows="3"></textarea>
      <div class="modal-footer d-block mr-auto">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="/PHP_CRUD_Operations/PHP-logo.svg" height="28px" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
            </ul>
            <form class="d-flex ms-auto" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      
      <?php
      if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been inserted successfully.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
      }
      ?>
      <?php
      if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been deleted successfully.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
      }
      ?>
      <?php
      if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been updated successfully.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
      }
      ?>
      <div class="container my-3">
        <h2>Add a Note to iNotes</h2>
        <form action="/PHP_CRUD_Operations/Index.php" method="POST">
          <div class="mb-3">
            <label for="title" class="form-label">Note Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
          <div class="mb-3">
            <label for="desc" class="form-label">Note Discription</label>
            <textarea class="form-control" id="descsiption" name="descsiption" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
      </div>

      <div class="container my-4">
        <table class="table" id="myTable">
  <thead>
    <hr>
    <tr>
      <th scope="col">Sr.No.</th>
      <th scope="col">Title</th>
      <th scope="col">Discription</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $SrNo = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $SrNo = $SrNo + 1;
          echo "<tr>
                <th scope='row'>" . $SrNo . "</th>
                <td>" . $row['Title'] . "</td>
                <td>" . $row['Description'] . "</td>
                <td> <button class='edit btn btn-sm btn-primary' id=".$row['SrNo'].">Edit</button> <button class='edit btn btn-sm btn-primary' id=".$row['SrNo'].">Edit</button><button class='delete btn btn-sm btn-primary' id=d".$row['SrNo'].">Delete</button> </td>
                </tr>";
        }
        ?>
    
  </tbody>
</table>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#myTable').DataTable();
      });
    </script>
    <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
          console.log("edit ", );
          tr = e.target.parentNode.parentNode;
          Title = tr.getElementsByTagName("td")[0].innerText;
          Discription = tr.getElementsByTagName("td")[1].innerText;
          console.log(Title, Discription);
          TitleEdit.value = Title;
          DiscriptionEdit.value = Discription;
          SrNoEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle');
        })
      })

      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
          console.log("edit ", );
          SrNo = e.target.id.substr(1, );

          if (confirm("Are you sure you want delete this note!")) {
            console.log("yes");
            window.location = "/PHP_CRUD_Opeations/Index.php?delete=${SrNo}";
            // TODO: Create a from and use post request to submit a form
          } else {
            console.log("no");
          }
       })
     </script>
   </body>
 </html>