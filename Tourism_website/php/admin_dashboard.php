<?php
session_start();


// Database connection settings
$servername = "localhost";  // server
$username = "root";         //  DB username
$password = "";             //  DB password
$dbname = "register_db";   // DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all inquiries
$sql = "SELECT userid, userName, useremail, usermessage FROM logindb ORDER BY userid DESC";
$result = $conn->query($sql);
  

       
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard Inquiry List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


  <style>
     body {
      background: #f8f9fa;
      min-height: 100vh;
      display: flex;
      margin: 0;
      font-family: Arial, sans-serif;
       
    }
    /* Sidebar styles */
    .sidebar {
      min-width: 320px;
      max-width: 320px;
      background-color:  #0a1128;
      color: white;
      padding: 1rem;
      height: 100vh;
    }
    .sidebar h4 {
      text-align: center;
      margin-bottom: 1rem;
    }
    .sidebar hr {
      border-color: #495057;
    }
    .sidebar span {
      color: #7C807F;
      display: block;
      margin: 1rem 0 0.5rem 0;
      padding-top:16px;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      display: block;
      border-radius: 4px;
      margin-bottom: 0.25rem;
      transition: background-color 0.3s ease;
    }
    .sidebar a:hover {
      background-color: #495057;
    }

    /* Content styles */
    #content {
      flex-grow: 1;
      padding: 20px;
      background: #f8f9fa;
    }
    .table thead th {
      background-color: #dee2e6;
    }
    .btn-view {
      background-color: #00a1b8;
      color: white;
    }
    .btn-warning {
      background-color: #ffc107;
      border: none;
      color: black;
      padding: 6px 10px;
      border-radius: 8px;
      font-size: 1.1rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.3s ease;
    }
    .btn-warning:hover {
      background-color: #e0a800;
      color: black;
    }
   
    

    .btn-info {
  background-color: #00bcd4; /* bright cyan/blue */
  border: none;
  color: white;
  padding: 6px 10px;
  border-radius: 8px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 1.1rem;
  transition: background-color 0.3s ease;
}

.btn-info:hover {
  background-color: #00a1b8; /* darker on hover */
  color: white;
}

.btn-info i {
  pointer-events: none; /* so only button triggers click */
}

  </style>
</head>
<body>
<div class="sidebar">
    <h4>TRAVEL</h4>
    <hr />
    <span>MAIN</span>
    <a href="admin_dashboard.php"><i class="fa fa-house"></i> Dashboard</a>
    <a href="admin_inquiry.php"><i class="fa fa-message"></i> Inquiry</a>
    <hr />
    <span>PAGES</span>
    <a href="admin_home.php"><i class="fa fa-file"></i> Home</a>
    <a href="#"><i class="fa fa-file"></i> Services</a>
    <a href="#"><i class="fa fa-file"></i> Contact</a>
    <hr/><br>
    <a href="logout.php" onclick="return confirm('Are you sure you want to log out?');"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>

  </div>



<div class="container mt-5">
  <h2><b>Dashboard</b></h2><br>
  <div class="table-responsive">
  <table id="inquiryTable" class="table table-striped">

    <thead>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- rows here -->
        <?php

$getDataquery = mysqli_query($conn, "SELECT * FROM logindb ORDER BY userid DESC");
                    //display all data
                    $n = 0;
                    while ($data = mysqli_fetch_array($getDataquery)) {
                        $n++;                    
                    ?>    
                        <tr> 
                            <th><?= $n ?></th>
                            <td><?=$data ['userName'] ?></td>
                            <td><?=$data ['useremail'] ?></td>
                            <td><?=$data ['userdate'] ?></td>
                            <td>
                                <a href="admin_inquiry.php"> <button class='btn btn-info btn-sm view-btn' data-id="{$data['userid']}"><i class='fa fa-eye'></i></button></a> 

                              
                            </td>
                        </tr>
                    <?php
                     }
                     ?>
    </tbody>
   

  </table>
</div>

</div>

<script>
  $(document).ready(function() {
    $('#inquiryTable').DataTable();
  });
</script>

</body>
</html>

<?php $conn->close(); ?>

    