<?php
  session_start();
  $conn = mysqli_connect("localhost", "root", "", "register_db") or die("Database connection failed!");

  $sql = "SELECT fcard_name, fcard_desc, fcard_Imglink, fcard_btnlink FROM fcard_db";
  
  $result = $conn->query($sql);
?>
<?php
$conn = new mysqli("localhost", "root", "", "register_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT car_id, car_img, car_title, car_desc FROM car_tb ORDER BY car_id ASC";
$carouselResult = $conn->query($sql);

if (!$carouselResult) {
    die("Query failed: " . $conn->error);
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
     <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css" />
    <!-- Bootstrap CSS (v3.4.1) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
    
      body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow-x: hidden;
      }   
      .main-head {
        position: fixed;
        top: 0;
        left: 0;
        width: 70px;
        height: 100vh;
        background-color: #0a1128;
        z-index: 1000;
        transition: width 0.3s ease-in-out;
        overflow: hidden;
      }   
      .main-head.active {
        width: 20%;
      }   
      .showcase {
        margin-left: 70px;
        transition: margin-left 0.3s ease-in-out;
        min-height: 100vh;
      }
      .main-head.active ~ .showcase {
        margin-left: 20%;
      }
      .showcase .head {
      padding: 13px 25px;
      /* REMOVE any position: relative here */
      }
      .showcase .head .toggler {
        /* Remove this block if you're using the fixed version */
      } 
      .toggler {
        position: fixed;
        top: 20px;
        left: 80px; /* Adjust left spacing */
        z-index: 1100;
        background: transparent;
        border: none;
        color: #fff;
        font-size: 24px;
        cursor: pointer;
      }
      .main-head.active ~ .toggler {
        left: 260px; /* Match expanded sidebar width */
      }
      .showcase .overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0, 0, 0, 0.6); /* semi-transparent dark overlay */
        z-index: 1;
      }
      .showcase > * {
        position: relative;
        z-index: 2; /* bring content above overlay */
      }      
      .carousel-control-prev-icon,
      .carousel-control-next-icon {
        background-color: rgba(0,0,0,0.5); /* adds visibility */
        border-radius: 50%;
      }    
      .carousel-inner img {
        height: 80vh;
        object-fit: cover;
        padding-right: 40px; /* ✅ Remove padding */
        padding-left:100px;
      }
      /* Ensure .head has no margin or padding */
      .head {
        margin: 0;
        padding: 0;
      }
      .flip-card {
        background-color: transparent;
        width: 100%;
        height: 200px;
        perspective: 1000px;
      }      
      .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.6s;
        transform-style: preserve-3d;
      }     
      .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
      }
      .flip-card-front,
      .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
      }      
      .flip-card-front {
        background-color: #fff;
        color: #FFF4EC;
        text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
        font-weight: bold;
        background-size: cover;
        background-position: center;
      }   
      .flip-card-back {
        background-color: #797B84;
        color: #fff;
        transform: rotateY(180deg);
        position: relative;
      }     
      .flip-card-back a {
        position: absolute;
        bottom: 10px;
        right:15px;
        color: #192A51;
        text-decoration: none;
        font-weight: bold;
        font-size: 0.9rem;
        border:1px solid black;
        padding:3px;
        background-color:#96939B ;  
        border-radius:5px;
      }      
      .flip-card-back a:hover{
        background-color:#fff;
      }     
      /* Ensure layout uses flex for horizontal positioning */
      .main-wrap {
        display: flex;
        height: 100vh;
      }     
      /* Sidebar default and expanded */
      .main-head {
        width: 70px;
        transition: width 0.3s ease;
      }     
      .main-head.active {
        width: 250px; /* Expanded width */
      }      
      /* Content area */
      .showcase {
        flex-grow: 1;
        transition: margin-left 0.3s ease;
        margin-left: 0px;
        overflow: auto;
      }   
      /* When sidebar is active, push content */
      .main-head.active ~ .showcase {
        margin-left: 0px;
      }      
      .text {
        text-align: center;
        margin: 30px auto;
        color: #fff;
        max-width: 800px;
      }     
      /* box description for the carousel */     
      .carousel-caption-box {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.6);
        color: #fff;
        padding: 15px 20px;
        border-radius: 10px;
        max-width: 80%;
        text-align: center;
        z-index: 10;
      }     
      .carousel-caption-box h5 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: bold;
      }     
      .carousel-caption-box p {
        margin: 5px 0 0;
        font-size: 1rem;
      }
    </style>
  </head>

  <body>
    <div class=" page-wrapper d-flex flex-column min-vh-100">
      <main class="main-wrap">
         <!-- Sidebar -->
         <header class="main-head">
           <div class="main-nav">
             <nav class="navbar">
               <div class="navbar-nav">
                 <div class="title">
                   <h3>
                   <i class="fa-solid fa-globe"></i>
                     <span class="title-text">Travel</span>
                   </h3>
                 </div>
                 <ul class="nav-list">
                    <li class="nav-list-item">
                      <a href="index.php" class="nav-link active">
                        <i class="fa-solid fa-house"></i>
                        <span class="link-text">Home</span>
                      </a>
                    </li>
                    <li class="nav-list-item">
                      <a href="service.php" class="nav-link ">
                        <i class="fa-solid fa-bell-concierge"></i>
                        <span class="link-text">Services</span>
                      </a>
                    </li>
                    <li class="nav-list-item">
                      <a href="contact.php" class="nav-link">
                        <i class="fa-solid fa-phone"></i>
                        <span class="link-text">Contact</span>
                      </a>
                    </li>
                    <li class="nav-list-item">
                      <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                       <i class="fa-solid fa-right-from-bracket"></i>
                       <span class="link-text">Login</span>
                      </a>            
                    </li>
                 </ul>
               </div>
             </nav>
           </div>
         </header>
   
      <!-- Main Content / Carousel Area -->
         <section class="showcase">
          <div class="overlay">
            <div class="head">
                <button class="toggler">
                  <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            
            <div id="demo" class="carousel slide" data-bs-ride="carousel">           
               <!-- Indicators/dots -->
               <div class="carousel-indicators">
                 <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                 <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                 <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                 <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                 <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
                 <button type="button" data-bs-target="#demo" data-bs-slide-to="5"></button>
                 <button type="button" data-bs-target="#demo" data-bs-slide-to="6"></button>
                 <button type="button" data-bs-target="#demo" data-bs-slide-to="7"></button>
                 <button type="button" data-bs-target="#demo" data-bs-slide-to="8"></button>
               </div>
               <!-- The slideshow/carousel -->
                 
                 <div class="carousel-inner">
                 <?php
                 if ($carouselResult && $carouselResult->num_rows > 0) {
                   $isFirst = true;
                   while ($row = $carouselResult->fetch_assoc()) {
                     // Mark first item active for Bootstrap carousel
                     $activeClass = $isFirst ? "active" : "";
                     $isFirst = false;
                 ?>
                   <div class="carousel-item <?= $activeClass ?>">
                     <img src="<?= htmlspecialchars($row['car_img']) ?>" alt="<?= htmlspecialchars($row['car_title']) ?>" class="d-block w-100" style="height: 80vh; object-fit: cover;">
                     <div class="carousel-caption-box">
                       <h5><?= htmlspecialchars($row['car_title']) ?></h5>
                       <p><?= htmlspecialchars($row['car_desc']) ?></p>
                     </div>
                   </div>
                 <?php
                   }
                 } else {
                   // Fallback if no carousel data in DB
                   echo '<div class="carousel-item active"><img src="./pic/default.jpg" alt="default" class="d-block w-100"><div class="carousel-caption-box"><h5>No Carousel Items</h5><p>Please add featured carousel items in admin.</p></div></div>';
                 }
                 ?>
               </div>
               
               
                   <!-- Left and right controls/icons -->
                   <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                     <span class="carousel-control-prev-icon"></span>
                   </button>
                   <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                     <span class="carousel-control-next-icon"></span>
                   </button><br>
               
              
            </div>
            
            <div class="text">
              <h1>"Top Destinations to Explore in the Philippines"</h1>
              <p>Uncover breathtaking landscapes, rich history, and unforgettable adventures across the islands.</p>
            </div>
            <!-- Flip Cards Section -->
            <div class="container py-4">
              <div class="row justify-content-center g-4">
                
                <?php if ($result && $result->num_rows > 0): ?>
                  <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                      <div class="flip-card">
                        <div class="flip-card-inner">
                          <div class="flip-card-front" style="background-image: url('<?= htmlspecialchars($row['fcard_Imglink']) ?>');">
                            <?= htmlspecialchars($row['fcard_name']) ?>
                          </div>
                          <div class="flip-card-back">
                            <p><?= htmlspecialchars($row['fcard_desc']) ?></p>
                            <a href="<?= htmlspecialchars($row['fcard_btnlink']) ?>" target="_blank">more</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endwhile; ?>
                <?php else: ?>
                  <p class="text-white text-center">No destinations available.</p>
                <?php endif; ?>
              </div>
             </div>
            
            </div>
          </div>
         </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
          <!-- Bootstrap Login Modal -->
          <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <form method="POST" action="admin_login_handler.php" class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="loginModalLabel">Login</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input name="username" type="text" class="form-control" id="username" required />
                  </div>
                  <div class="mb-3"> 
                    <label for="pass" class="form-label">Password</label>
                    <div class="input-group">
                      <input name="password" type="password" class="form-control" id="pass" required />
                      <span class="input-group-text" onclick="togglePassword()" style="cursor:pointer;">
                        <i class="fa fa-eye" id="toggleIcon"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Login</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              </form>
            </div>
          </div>
      </main>
      <?php include 'footer.php'; ?> 
    </div>  
  </body>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const toggler = document.querySelector('.toggler');
          const sidebar = document.querySelector('.main-head');
          const showcase = document.querySelector('.showcase');
      
          if (toggler && sidebar && showcase) {
            toggler.addEventListener('click', () => {
              sidebar.classList.toggle('active');
              showcase.classList.toggle('active');
            });
          }
        });
      
      </script>
      
      <script>
        function togglePassword() {
          const pass = document.getElementById('pass');
          const icon = document.getElementById('toggleIcon');
          if (pass.type === 'password') {
            pass.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
          } else {
            pass.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
          }
        }
      </script>
      

</html>