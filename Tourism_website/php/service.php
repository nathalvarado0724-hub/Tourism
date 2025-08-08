<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>service</title>
     <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/style.css" />

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
  .showcase .overlay {
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: rgba(0, 0, 0, 0.6); /* semi-transparent dark overlay */
  z-index: 1;
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


 /* Flip card container */
 .flip-card {
  background-color: transparent;
  width: 400px;
  height: 300px;
  perspective: 1000px; /* Adds 3D effect */
  margin: auto;
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

.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.flip-card-front {
  background-color: #f0f0f0;
  color: black;
  display: flex;
  flex-direction: column;
}

.flip-card-front img {
  height: 50%;
  width: 100%;
  object-fit: cover;
}

.flip-card-front .card-text {
  height: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  text-align: center;
  font-size: 20px;
  font-weight: 600;
  
}

.flip-card-back {
  background-color:rgb(69, 98, 117);
  color: white;
  transform: rotateY(180deg);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start; /* Aligns content to the left */
  text-align: left;        /* Aligns text to the left */
  padding: 20px 30px;      /* More space for breathing room */
  font-size: 16px;
  line-height: 1.5;
}


h1  {
  text-align:center;
  color:white;
  padding:20px;
}
h2  {
  text-align:center;
  color:white;
  padding-bottom:20px;
}


</style>
</head>
<body>
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
            <a href="index.php" class="nav-link">
              <i class="fa-solid fa-house"></i>
              <span class="link-text">Home</span>
            </a>
          </li>
          <li class="nav-list-item">
            <a href="service.php" class="nav-link  active">
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
          <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#loginModal">
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
      <h1>Our Services</h1>
      <h2>Discover the beauty of the Philippines with flexible travel options tailored to every kind of explorer.</h2>
<!-- Flip Cards Section -->
<div class="container py-4">
  <div class="row justify-content-center g-4">

  <div class="col-md-4">
    <div class="flip-card">
      <div class="flip-card-inner">
       <div class="flip-card-front d-flex flex-column align-items-center">
        <img src="./pic/starter.jpg" alt="bag" class="img-fluid" style="height: 70%; width: 100%; object-fit: cover;">
       <div class="p-2 text-center" style="height: 50%; width: 100%; ;">
        <h4>Starter Tour</h4>
        <h5 class="mb-0">Price: $0 / trip</h5>
       </div>
       </div>
       <div class="flip-card-back d-flex justify-content-center align-items-center p-3 text-white">
        <p>Includes:</p>
        <ul>
        <li>2 guided tours</li>
        <li>3 Days / 2 Nights stay</li>
        <li>Travel e-booklet</li>
        <li>Basic email support Great for students and first-time backpackers on a budget.</li>
        </ul>
      </div>
     </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="flip-card">
      <div class="flip-card-inner">
       <div class="flip-card-front d-flex flex-column align-items-center">
        <img src="./pic/ride.jpg" alt="bus" class="img-fluid" style="height: 70%; width: 100%; object-fit: cover;">
       <div class="p-2 text-center" style="height: 50%; width: 100%; ;">
        <h4> Explorer Pass</h4>
       <h5 class="mb-0">Price: $19 / trip</h5>
       </div>
       </div>
       <div class="flip-card-back d-flex justify-content-center align-items-center p-3 text-white">
         <p>Includes:</p>
         <ul>
         <li>5 Days / 4 Nights accommodation</li>
         <li>3Up to 5 major attractions</li>
         <li>Free souvenir bag</li>
         <li>On-call travel coordinator</li>
         <li>Chat support included Perfect for weekend warriors and couples.</li>
         </ul>
      </div>
     </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="flip-card">
      <div class="flip-card-inner">
       <div class="flip-card-front d-flex flex-column align-items-center">
        <img src="./pic/island.jpg" alt="island" class="img-fluid" style="height: 70%; width: 100%; object-fit: cover;">
       <div class="p-2 text-center" style="height: 50%; width: 100%; ;">
        <h4> Island Elite</h4>
        <h5 class="mb-0">Price: $45 / trip</h5>
       </div>
       </div>
       <div class="flip-card-back d-flex justify-content-center align-items-center p-3 text-white">
         <p>Includes:</p>
         <ul>
         <li>7 Days / 6 Nights at 4-star resorts</li>
         <li>Unlimited island hopping</li>
         <li>Private transportation</li>
         <li>Personal travel assistant</li>
         <li>24/7 customer support For travelers who want luxury and convenience.</li>
         </ul>
      </div>
     </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="flip-card">
      <div class="flip-card-inner">
       <div class="flip-card-front d-flex flex-column align-items-center">
        <img src="./pic/camping.jpg" alt="camping" class="img-fluid" style="height: 70%; width: 100%; object-fit: cover;">
       <div class="p-2 text-center" style="height: 50%; width: 100%; ;">
        <h4>Eco Adventure</h4>
        <h5 class="mb-0">Price: $25 / trip</h5>
       </div>
       </div>
       <div class="flip-card-back d-flex justify-content-center align-items-center p-3 text-white">
         <p>Includes:</p>
         <ul>
         <li>Camping gear rental</li>
         <li>Nature hikes with a guide</li>
         <li>Tribal village visit</li>
         <li>Community immersion experience</li>
         <li>Free trail map Best for nature lovers and eco-tourists.</li>
         </ul>
      </div>
     </div>
    </div>
  </div>

    <div class="col-md-4">
    <div class="flip-card">
      <div class="flip-card-inner">
       <div class="flip-card-front d-flex flex-column align-items-center">
        <img src="./pic/culture.jpg" alt="culture" class="img-fluid" style="height: 70%; width: 100%; object-fit: cover;">
       <div class="p-2 text-center" style="height: 50%; width: 100%; ;">
        <h4> Cultural Heritage Tour</h4>
        <h5 class="mb-0">Price: $20 / tripT</h5>
       </div>
       </div>
       <div class="flip-card-back d-flex justify-content-center align-items-center p-3 text-white">
         <p>Includes:</p>
         <ul>
         <li>Historic site visits (churches, forts, museums)</li>
         <li>Local tour guide with stories</li>
         <li>Traditional food tasting</li>
         <li>Arts & crafts souvenir</li>
         <li>Local dance show experience Great for history buffs and curious minds.</li>
         </ul>
      </div>
     </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="flip-card">
      <div class="flip-card-inner">
       <div class="flip-card-front d-flex flex-column align-items-center">
        <img src="./pic/cruise.jpg" alt="cruise" class="img-fluid" style="height: 70%; width: 100%; object-fit: cover;">
       <div class="p-2 text-center" style="height: 50%; width: 100%; ;">
        <h4>River Cruise Escape</h4>
        <h5 class="mb-0">Price: $35 / trip</h5>
       </div>
       </div>
       <div class="flip-card-back d-flex justify-content-center align-items-center p-3 text-white">
         <p>Includes:</p>
         <ul>
         <li>2-hour scenic river cruise</li>
         <li>Buffet on board</li>
         <li>Acoustic live music</li>
         <li>Bamboo raft activities</li>
         <li>Drone photo & video service A romantic and relaxing trip for couples and families.</li>
         </ul>
      </div>
     </div>
    </div>
  </div>
</div>
</section>




      <script src="../js/style.js"></script>
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