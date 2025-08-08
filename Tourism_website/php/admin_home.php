<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update Flip Card
if (isset($_POST['update_card'])) {
    $id = intval($_POST['fcard_id']);
    $name = mysqli_real_escape_string($conn, $_POST['fcard_name']);
    $desc = mysqli_real_escape_string($conn, $_POST['fcard_desc']);
    $btnLink = mysqli_real_escape_string($conn, $_POST['fcard_btnlink']);

    // File upload handling
    $img = '';
    if (!empty($_FILES['fcard_img_file']['name'])) {
        $target_dir = "uploads_flipcard/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        $target_file = $target_dir . basename($_FILES['fcard_img_file']['name']);
        move_uploaded_file($_FILES['fcard_img_file']['tmp_name'], $target_file);
        $img = $target_file; // use uploaded file
    } else {
        $img = mysqli_real_escape_string($conn, $_POST['fcard_img_url']); // use URL
    }

    // Include fcard_Imglink in update
    $updateSql = "UPDATE fcard_db 
                  SET fcard_name = '$name',
                      fcard_desc = '$desc',
                      fcard_Imglink = '$img',
                      fcard_btnlink = '$btnLink'
                  WHERE fcard_id = $id";

    $msg = mysqli_query($conn, $updateSql)
        ? "<label style='color:green'>Card Updated Successfully!</label>"
        : "<label style='color:red'>Error Updating Card!</label>";
}


if (isset($_POST['update_carousel'])) {
    $id = intval($_POST['car_id']);
    $title = mysqli_real_escape_string($conn, $_POST['car_title']);
    $desc = mysqli_real_escape_string($conn, $_POST['car_desc']);

    // File upload handling
    $img = '';
    if (!empty($_FILES['car_img_file']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        
        $target_file = $target_dir . basename($_FILES['car_img_file']['name']);
        move_uploaded_file($_FILES['car_img_file']['tmp_name'], $target_file);
        $img = $target_file; // use uploaded file
    } else {
        $img = mysqli_real_escape_string($conn, $_POST['car_img_url']); // use URL
    }

    $updateSql = "UPDATE car_tb 
                  SET car_img = '$img',
                      car_title = '$title',
                      car_desc = '$desc'
                  WHERE car_id = $id";

    $msg = mysqli_query($conn, $updateSql)
        ? "<label style='color:green'>Carousel Updated Successfully!</label>"
        : "<label style='color:red'>Error Updating Carousel!</label>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background: #f8f9fa;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }
        .sidebar {
      min-width: 320px;
      max-width: 320px;
      background-color:  #0a1128;
      color: white;
      padding: 1rem;
      height: 100vh;
      position:fixed;   
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

        .container {
            margin-left: 370px;
            padding: 30px 40px;
        }
        .table thead th {
            background-color: #343a40;
            color: white;
            text-align: center;
        }
        .table td img {
            border-radius: 6px;
            object-fit: cover;
        }
        .modal-header {
            background-color: #0a1128;
            color: white;
        }
        .modal-footer .btn-success {
            background-color: #198754;
            border: none;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .container {
                margin-left: 0;
                padding: 20px;
            }
        }
       /* combine image and text */
        .image-container {
            position: relative;
            display: inline-block;
            width: 150px;
            height: 100px;
        }
        
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 4px;
        }
        
        .image-text {
            position: absolute;
            bottom: 5px;
            left: 5px;
            right: 5px;
            color: white;
            font-weight: bold;
            font-size: 12px;
            text-shadow: 1px 1px 2px black;
            background: rgba(0, 0, 0, 0.5);
            padding: 2px 5px;
            border-radius: 3px;
            text-align: center;
            text-transform: uppercase;
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
    <hr /><br>
    <a href="logout.php" onclick="return confirm('Are you sure you want to log out?');"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<div class="container mt-5">
    <h1><b>Manage Home Page</b></h1> <hr />  <?php if (isset($msg)) echo $msg; ?>
<h2>Featured Carousel</h2><br>
<div class="table-responsive">
    <table id="inquiryTable1" class="table table-striped table-hover table-bordered">
        <thead>
            <tr align="center">
                <th>No.</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $getDataquery = mysqli_query($conn, "SELECT * FROM car_tb ORDER BY car_id DESC");
        $n = 0;
        while ($data = mysqli_fetch_array($getDataquery)) {
            $n++;
        ?>
            <tr align="center">
                <th><?= $n ?></th>
                <td>
                    <div class="image-container">
                        <img src="<?= $data['car_img'] ?>" alt="Image" width="150" height="100">
                        <div class="image-text"><?= $data['car_title'] ?></div>
                    </div>
                </td>
                <td><?= $data['car_desc'] ?></td>
                <td>
                    <!-- Button -->
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#carouselModal<?= $data['car_id'] ?>">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="carouselModal<?= $data['car_id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Carousel</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="car_id" value="<?= $data['car_id'] ?>">
                                <div class="mb-3">
                                   <!-- Allow both text or file -->
                                  <label>Image (URL or Upload):</label>
                                  <input type="text" name="car_img_url" class="form-control mb-2" placeholder="Paste image URL (optional)" value="<?= $data['car_img'] ?>">
                                  <input type="file" name="car_img_file" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Title:</label>
                                    <input type="text" name="car_title" class="form-control" value="<?= $data['car_title'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label>Description:</label>
                                    <textarea name="car_desc" class="form-control" required><?= $data['car_desc'] ?></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="update_carousel" class="btn btn-success">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
        </tbody>
    </table>
    
    <hr />
    <?php if (isset($msg)) echo $msg; ?>  
    <h2>Featured Flip Card</h2><br>
    <div class="table-responsive">
        <table id="inquiryTable" class="table table-striped table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th>No.</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $getDataquery = mysqli_query($conn, "SELECT * FROM fcard_db ORDER BY fcard_id DESC");
            $n = 0;
            while ($data = mysqli_fetch_array($getDataquery)) {
                $n++;
                       ?>
                           <tr align="center">
               <th><?= $n ?></th>
               <td>
                   <div class="image-container">
                       <img src="<?= $data['fcard_Imglink'] ?>" alt="Image" width="250" height="100">
                       <div class="image-text"><?= $data['fcard_name'] ?></div>
                   </div>
               </td>
               <td><?= $data['fcard_desc'] ?></td>
               <td>
                   <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $data['fcard_id'] ?>">
                       <i class="fa-solid fa-pen-to-square"></i> Edit
                   </button>
               </td>
           </tr>


                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?= $data['fcard_id'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <form method="POST" action="" enctype="multipart/form-data">>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Flip Card</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="fcard_id" value="<?= $data['fcard_id'] ?>">
                                    <div class="mb-3">
                                        <label>Name:</label>
                                        <input type="text" name="fcard_name" class="form-control" value="<?= $data['fcard_name'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Description:</label>
                                        <textarea name="fcard_desc" class="form-control" required><?= $data['fcard_desc'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                    <label>Image (URL or Upload):</label>
                                    <input type="text" name="fcard_img_url" class="form-control mb-2" placeholder="Paste image URL (optional)" value="<?= $data['fcard_Imglink'] ?>">
                                    <input type="file" name="fcard_img_file" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>More Button Link:</label>
                                        <input type="text" name="fcard_btnlink" class="form-control" value="<?= $data['fcard_btnlink'] ?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="update_card" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
            </tbody>
        </table>
    </div>

 
  
</div>


<!-- Scripts -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function () {
    $('#inquiryTable').DataTable({
      autoWidth: false,
      columnDefs: [
        { targets: 0, width: '10px' },
        { targets: 1, width: '200px' },
        { targets: 2, width: '300px' },
        { targets: 3, width: '10px' }
      ]
    });

    $('#inquiryTable1').DataTable({
      autoWidth: false,
      columnDefs: [
        { targets: 0, width: '10px' },
        { targets: 1, width: '200px' },
        { targets: 2, width: '300px' },
        { targets: 3, width: '10px' }
      ]
    });
  });
</script>
</body>
</html>
