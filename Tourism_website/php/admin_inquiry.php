<?php
session_start();
$conn = new mysqli("localhost", "root", "", "register_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);  
}

// Fetch inquiries ordered by latest
$getDataquery = $conn->query("SELECT * FROM logindb ORDER BY userid DESC");

// Handle delete action securely
if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'delete') {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM logindb WHERE userid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: #");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inquiry List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
  
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

    /* Main content */
    #content {
      flex-grow: 1;
      padding: 20px;
    }

    h2 {
      margin-bottom: 1rem;
    }
    hr {
      margin-bottom: 2rem;
      border-color: #dee2e6;
    }

    /* Table styles */
    table.table {
      width: 100%;
    }
    thead.table-dark th {
      background-color: #343a40;
      color: white;
    }

    /* Button styles */
    .btn-info {
      background-color: #00bcd4;
      border: none;
      color: white;
      padding: 6px 10px;
      border-radius: 8px;
      font-size: 1.1rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.3s ease;
    }
    .btn-info:hover {
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

    /* Message box */
    .message-box {
      background-color: white;
      border-radius: 5px;
      padding: 20px;
      height: 100%;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
    <hr /> <br>
    <a href="logout.php" onclick="return confirm('Are you sure you want to log out?');"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
  </div>

  <div id="content">
    <h2>Inquiry/Message</h2>
    <hr />
    <div class="row">
      <!-- Inquiry List Table -->
      <div class="col-md-6">
        <h5>List of Inquiry</h5>
        <table id="inquiryTable" class="table table-striped">
          <thead class="table-dark">
            <tr>
              <th>No.</th>    
              <th>Name</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $n = 0;
            while ($data = $getDataquery->fetch_assoc()) {
                $n++;
                echo "<tr>";
                echo "<td>{$n}</td>";
                echo "<td>" . htmlspecialchars($data['userName']) . "</td>";
                echo "<td>" . date("F d, Y h:i:s A", strtotime($data['userdate'])) . "</td>";
                echo "<td class='table-actions'>
                        <button class='btn btn-info btn-sm view-btn' data-id='{$data['userid']}'><i class='fa fa-eye'></i></button>
                        <a href='?id={$data['userid']}&action=delete' class='btn btn-warning btn-sm' onclick=\"return confirm('Are you sure you want to delete this inquiry?');\"><i class='fa fa-trash'></i></a>
                      </td>";
                echo "</tr>";  
            }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Message Viewer -->
      <div class="col-md-6">
        <div class="message-box">
          <h5>From: <span id="senderName">[Select an inquiry]</span></h5>
          <p id="messageBody" class="mt-3"></p>
          <p><strong>Email:</strong> <span id="senderEmail"></span></p>
          <p><strong>Date:</strong> <span id="senderDate"></span></p>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $(".view-btn").click(function() {
        var id = $(this).data("id");

        $.ajax({
            url: "get_inquiry.php",
          method: "POST",
          data: { id: id },
          dataType: "json",
          success: function(data) {
            $("#senderName").text(data.userName || "No Name");
            $("#messageBody").text(data.usermessage || "No message");
            $("#senderEmail").text(data.useremail || "N/A");
            $("#senderDate").text(data.userdate || "N/A");
          },
          error: function() {
            alert("Failed to fetch inquiry details.");
          }
        });
      });
    });

    $(document).ready(function() {
    $('#inquiryTable').DataTable();
  });
  </script>
</body>
</html>
