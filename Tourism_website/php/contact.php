<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
     <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/style.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


  <style>
    /* Contact Container */
    .contact-container {
  display: flex;
  justify-content: center; /* center horizontally */
  align-items: center;     /* center vertically */
  gap: 50px;               /* space between text and form */
  height: 70vh;            /* take most of viewport height */
  max-width: 900px;
  margin: 0 auto;          /* center container horizontally */
  padding: 20px;
  box-sizing: border-box;
}

.contact-left {
  background: #f7f9fc;     /* light background for form */
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgb(0 0 0 / 0.1);
  flex: 0 0 350px;         /* fixed width for form */
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.contact-left input,
.contact-left textarea {
  width: 100%;
  padding: 8px 12px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

.contact-left button {
  background-color:rgb(122, 14, 64);
  border: none;
  color: white;
  padding: 12px;
  font-size: 16px;
  font-weight: 600;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.contact-left button:hover {
  background-color:rgb(161, 60, 99);
}

.contact-right {
  flex: 1;
  max-width: 400px;
  color: #333;
}

.contact-right h1 {
  font-weight: 700;
  margin-bottom: 10px;
}

.contact-right p {
  font-size: 16px;
  line-height: 1.5;
  max-width: 360px;
}


/* Responsive */
@media (max-width: 992px) {
  .contact-container {
    flex-direction: column;
    align-items: center;
  }

  .contact-right {
    text-align: center;
  }
}

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
  top: 15px;
  left: 80px; /* enough space from sidebar */
  z-index: 1100;
  background: transparent;
  border: none;
  outline: 0;
  color: #fff;
  cursor: pointer;
  padding: 10px;
  border-radius: 5px;
  transition: 0.2s ease;
}

.main-head.active ~ .toggler {
  left: 22%;
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
            <a href="service.php" class="nav-link ">
              <i class="fa-solid fa-bell-concierge"></i>
              <span class="link-text">Services</span>
            </a>
          </li>
          <li class="nav-list-item">
            <a href="contact.php" class="nav-link active">
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
      
      <div class="contact-container">
     <form action="submit_message.php" method="POST" class="contact-left">
            <div class="contact-left-title">
                <h2><b>MESSAGE US </b></h2>
                <hr>
            </div>
            <input type="text" name="name" placeholder="Your name:" class="contact-inputs" required >
            <input type="text" name="email" placeholder="Your email" class="contact-inputs" required>
            <textarea name="message" placeholder="your message" class="contact-inputs" required></textarea>
            <div class="form-group" style="padding-left:15px;">        
      <div class="col-sm-offset-2 col-sm-10">
        <div>
          <label>By clicking Submit, you agree to the terms of use. </label>
        </div>
      </div>
    </div>
            <button type="submit">Submit</button>
        </form>
        <div class="col-lg-4 text-center text-lg-start">
						<h1 class="display-3 fw-bold lh-1 mb-3"><b>Contact Us!!!</b></h1>
						<p class="col-lg-10 fs-4">Send us an enquiry, or rate us! By sending us with  your feedback we can improve our services tailored with your needs.</p>
					</div>
     <div class="contact-right"></div>
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