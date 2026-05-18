<?php
session_start();

// Only require session check for accessing protected services
// Homepage itself is publicly accessible
$require_login = false;

// Check if user is trying to access a protected service
if (isset($_GET['service']) && $_GET['service'] === 'protected') {
    $require_login = true;
}

// If login is required but user is not logged in, redirect to login page
if ($require_login && (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("Location: /ACCOUNTS/Login.php");
    exit();
}

// Update last activity time for logged-in users
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $_SESSION['last_activity'] = time();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mental Health Support</title>
  <link rel="stylesheet" href="home.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    /* Updated Settings Button Style to perfectly match the image */
    .settings-btn {
      background-color: #2c6e49 !important;
      color: white !important;
      border-radius: 30px !important;
      padding: 8px 15px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      text-decoration: none !important;
      font-weight: 500 !important;
      transition: all 0.2s ease !important;
      border: none !important;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
      margin-left: 10px !important;
      font-size: 0.9rem !important;
    }
    
    .settings-btn i {
      margin-right: 5px !important;
      font-size: 0.9rem !important;
    }
    
    .settings-btn:hover {
      background-color: #235c3a !important;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15) !important;
    }
  </style>
</head>
<body>
<header>
  <div class="header-container">
    <h1 class="logo">
      <img src="/images/m2.png" alt="CGS Logo" />
    </h1>
    <nav>
      <a href="Home.php" class="btn_home">Home</a>
      <a href="about.php" class="btn_about">About</a>
      <a href="contact.php" class="btn_contact">Contact</a>
     
      
      <?php if (isset($_SESSION['username'])): ?>
  <div class="dropdown">
  <button class="dropbtn">Services</button>
  <div class="dropdown-content">
    <a href="services/Report.php">Make a report</a>
    <a href="services/appoint.php">Appoint counseling session</a>
    <a href="services/my_appointments.php">My Appointments</a>
    <a href="/services/checklist.php">Check List</a>
  </div>
  </div>
        <div class="user-controls">
          <div class="user-avatar">
            <?php if (!empty($_SESSION['avatar'])): ?>
              <img src="<?php echo $_SESSION['avatar']; ?>" alt="User Avatar">
            <?php else: ?>
              <img src="/images/default-avatar.php?letter=<?php echo urlencode($_SESSION['username'][0]); ?>" alt="Avatar">
            <?php endif; ?>
          </div>
          <span class="welcome">Welcome, <?php echo $_SESSION['username']; ?>!</span>
          <a href="#" class="settings-btn" id="open-settings-modal"><i class="fas fa-cog"></i> Settings</a>
          <a href="/ACCOUNTS/Logout.php" class="btn">Logout</a>
        </div>
      <?php else: ?>
        <a href="/ACCOUNTS/Login.php" class="btn">Login</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<!-- Settings Modal -->
<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
<div id="settings-modal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Account Settings</h2>
      <span class="close-modal">&times;</span>
    </div>
    
    <div class="settings-tabs">
      <button class="tab-button active" data-tab="avatar-tab">
        <i class="fas fa-user-circle"></i> Profile Picture
      </button>
      <button class="tab-button" data-tab="details-tab">
        <i class="fas fa-user-edit"></i> Personal Details
      </button>
      <button class="tab-button" data-tab="password-tab">
        <i class="fas fa-key"></i> Change Password
      </button>
    </div>
    
    <!-- Avatar Tab -->
    <div id="avatar-tab" class="tab-content active">
      <div id="avatar-message"></div>
      <form id="avatar-form" enctype="multipart/form-data">
        <div class="avatar-container">
          <div class="avatar-preview">
            <?php if (!empty($_SESSION['avatar'])): ?>
              <img src="<?php echo $_SESSION['avatar']; ?>" alt="User Avatar" id="avatar-preview-img">
            <?php else: ?>
              <img src="/images/default-avatar.php?letter=<?php echo urlencode($_SESSION['username'][0]); ?>" alt="Default Avatar" id="avatar-preview-img">
            <?php endif; ?>
          </div>
          <div class="avatar-upload-btn">
            <button type="button" class="submit-btn" style="width: auto; padding: 10px 20px;">
              <i class="fas fa-camera"></i> Choose Image
            </button>
            <input type="file" name="avatar" id="avatar-upload" accept="image/*">
          </div>
        </div>
        
        <p style="text-align: center; margin-bottom: 20px; color: #666;">
          Allowed formats: JPG, JPEG, PNG, GIF. Max size: 2MB
        </p>
        
        <button type="submit" class="submit-btn">
          <i class="fas fa-save"></i> Update Profile Picture
        </button>
      </form>
    </div>
    
    <!-- Personal Details Tab -->
    <div id="details-tab" class="tab-content">
      <div id="details-message"></div>
      <form id="details-form">
        <div class="form-group">
          <label for="full_name">Full Name</label>
          <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo htmlspecialchars($_SESSION['full_name'] ?? ''); ?>" required>
        </div>
        
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" required>
        </div>
        
        <div class="form-group">
          <label for="contact_number">Contact Number</label>
          <input type="text" id="contact_number" name="contact_number" class="form-control" value="<?php echo htmlspecialchars($_SESSION['contact_number'] ?? ''); ?>">
        </div>
        
        <div class="form-group">
          <label for="student_number">Student Number</label>
          <input type="text" id="student_number" class="form-control" value="<?php echo htmlspecialchars($_SESSION['stud_num'] ?? 'N/A'); ?>" disabled>
          <small style="color: #666;">Student number cannot be changed</small>
        </div>
        
        <div class="form-group">
          <label for="account_type">Account Type</label>
          <input type="text" id="account_type" class="form-control" value="<?php echo ucfirst(htmlspecialchars($_SESSION['account_type'] ?? '')); ?>" disabled>
        </div>
        
        <button type="submit" class="submit-btn">
          <i class="fas fa-save"></i> Save Changes
        </button>
      </form>
    </div>
    
    <!-- Change Password Tab -->
    <div id="password-tab" class="tab-content">
      <div id="password-message"></div>
      <form id="password-form">
        <div class="form-group">
          <label for="current_password">Current Password</label>
          <input type="password" id="current_password" name="current_password" class="form-control" required>
        </div>
        
        <div class="form-group">
          <label for="new_password">New Password</label>
          <input type="password" id="new_password" name="new_password" class="form-control" required>
          <div class="password-strength">
            <div class="password-strength-meter"></div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="confirm_password">Confirm New Password</label>
          <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
        </div>
        
        <button type="submit" class="submit-btn">
          <i class="fas fa-key"></i> Update Password
        </button>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<section class="hero">
  <div class="overlay">
    <h1>GUIDANCE SERVICES</h1>
  </div>
</section>

<section class="content">
  <div class="container">
    <blockquote>
      Being an integral part of the Our Lady of Fatima University's educational program, 
      the Center for Guidance Services (CGS) plays a significant role in molding the youth of today—
      some of whom could be beset with confusion, conflicts, problems or maladjustment.
    </blockquote>
    <p>
      CGS is dedicated to the continuous search for appropriate and effective interventions in understanding 
      and helping students with issues that plague them; issues that could very well hinder them from 
      learning and growing as individuals.
    </p>

    <h2>Vision</h2>
    <p>
      The Center for Guidance Services envisions itself to be the central service component of the institution 
      focused on the continuous improvement of the students' holistic formation.
    </p>

    <h2>Mission</h2>
    <p>
      We commit ourselves to help students become more well-adjusted, competent and endowed with compassionate 
      values that will help them develop more satisfying relationships within the family, school, community, and 
      the society.
    </p>
    <p>
      We advocate for academic success of all students by being more responsible in helping them improve holistically 
      through the effective implementation of the various guidance services.
    </p>

    <h2>Objectives</h2>
    <ul>
      <li>Implement responsive, relevant and effective guidance programs & activities.</li>
      <li>Initiate useful, timely and relevant researches focused on guidance services.</li>
      <li>Develop more committed means of soliciting clients' feedbacks.</li>
      <li>Assist students in coping with emotional and social difficulties through strengthening counseling services.</li>
      <li>Evaluate counselor competencies through post-graduate studies and regular evaluation.</li>
    </ul>

    <h2>Guidance Services</h2>
    <p>
      Guidance is a cluster of integrated, correlated and coordinated services that assists individuals in dealing 
      with life's challenges to become self-directed in making choices, plans, and adjustments.
    </p>
  </div>
</section>

<footer>
  <p>&copy; 2025 Mental Health Support. All rights reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  // Modal functionality
  const modal = document.getElementById('settings-modal');
  const openModalBtn = document.getElementById('open-settings-modal');
  const closeModalBtn = document.querySelector('.close-modal');
  
  if (openModalBtn) {
    openModalBtn.addEventListener('click', function(e) {
      e.preventDefault();
      modal.classList.add('show');
      document.body.style.overflow = 'hidden';
    });
  }
  
  if (closeModalBtn) {
    closeModalBtn.addEventListener('click', function() {
      modal.classList.remove('show');
      document.body.style.overflow = '';
    });
  }
  
  // Close modal when clicking outside
  window.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.classList.remove('show');
      document.body.style.overflow = '';
    }
  });
  
  // Tab switching
  const tabButtons = document.querySelectorAll('.tab-button');
  const tabContents = document.querySelectorAll('.tab-content');
  
  tabButtons.forEach(button => {
    button.addEventListener('click', function() {
      // Remove active class from all buttons and contents
      tabButtons.forEach(btn => btn.classList.remove('active'));
      tabContents.forEach(content => content.classList.remove('active'));
      
      // Add active class to current button
      this.classList.add('active');
      
      // Show corresponding content
      const tabId = this.getAttribute('data-tab');
      document.getElementById(tabId).classList.add('active');
    });
  });
  
  // Avatar preview functionality
  const avatarUpload = document.getElementById('avatar-upload');
  const avatarPreview = document.getElementById('avatar-preview-img');
  
  if (avatarUpload) {
    avatarUpload.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          avatarPreview.src = e.target.result;
        }
        
        reader.readAsDataURL(this.files[0]);
      }
    });
    
    // Click on button to trigger file input
    const uploadButton = document.querySelector('.avatar-upload-btn .submit-btn');
    uploadButton.addEventListener('click', function() {
      avatarUpload.click();
    });
  }
  
  // Password strength meter
  const passwordInput = document.getElementById('new_password');
  const strengthMeter = document.querySelector('.password-strength-meter');
  
  if (passwordInput) {
    passwordInput.addEventListener('input', function() {
      const password = this.value;
      let strength = 0;
      
      // Length check
      if (password.length >= 8) strength += 1;
      
      // Contains lowercase
      if (/[a-z]/.test(password)) strength += 1;
      
      // Contains uppercase
      if (/[A-Z]/.test(password)) strength += 1;
      
      // Contains numbers
      if (/[0-9]/.test(password)) strength += 1;
      
      // Contains special characters
      if (/[^A-Za-z0-9]/.test(password)) strength += 1;
      
      // Update strength meter
      strengthMeter.style.width = (strength * 20) + '%';
      
      // Set color based on strength
      if (strength < 2) {
        strengthMeter.style.backgroundColor = '#dc3545'; // Weak
      } else if (strength < 4) {
        strengthMeter.style.backgroundColor = '#ffc107'; // Medium
      } else {
        strengthMeter.style.backgroundColor = '#28a745'; // Strong
      }
    });
  }
  
  // Form submissions with AJAX
  
  // Avatar form
  $('#avatar-form').on('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    $.ajax({
      url: 'services/api/update_avatar.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        try {
          const result = JSON.parse(response);
          
          if (result.status === 'success') {
            $('#avatar-message').html(`<div class="alert alert-success">${result.message}</div>`);
            
            // Update header avatar
            if (result.avatar_url) {
              $('.user-avatar img').attr('src', result.avatar_url);
            }
            
            // Update session avatar
            if (result.avatar_url) {
              // This is handled server-side
            }
          } else {
            $('#avatar-message').html(`<div class="alert alert-danger">${result.message}</div>`);
          }
        } catch (e) {
          $('#avatar-message').html('<div class="alert alert-danger">An error occurred while processing your request.</div>');
        }
      },
      error: function() {
        $('#avatar-message').html('<div class="alert alert-danger">An error occurred while uploading your avatar.</div>');
      }
    });
  });
  
  // Personal details form
  $('#details-form').on('submit', function(e) {
    e.preventDefault();
    
    const formData = $(this).serialize();
    
    $.ajax({
      url: 'services/api/update_details.php',
      type: 'POST',
      data: formData,
      success: function(response) {
        try {
          const result = JSON.parse(response);
          
          if (result.status === 'success') {
            $('#details-message').html(`<div class="alert alert-success">${result.message}</div>`);
            
            // Update displayed name if needed
            if (result.full_name) {
              // This would update any UI elements showing the name
            }
          } else {
            $('#details-message').html(`<div class="alert alert-danger">${result.message}</div>`);
          }
        } catch (e) {
          $('#details-message').html('<div class="alert alert-danger">An error occurred while processing your request.</div>');
        }
      },
      error: function() {
        $('#details-message').html('<div class="alert alert-danger">An error occurred while updating your details.</div>');
      }
    });
  });
  
  // Password change form
  $('#password-form').on('submit', function(e) {
    e.preventDefault();
    
    const newPassword = $('#new_password').val();
    const confirmPassword = $('#confirm_password').val();
    
    // Check if passwords match
    if (newPassword !== confirmPassword) {
      $('#password-message').html('<div class="alert alert-danger">Passwords do not match.</div>');
      return;
    }
    
    const formData = $(this).serialize();
    
    $.ajax({
      url: 'services/api/update_password.php',
      type: 'POST',
      data: formData,
      success: function(response) {
        try {
          const result = JSON.parse(response);
          
          if (result.status === 'success') {
            $('#password-message').html(`<div class="alert alert-success">${result.message}</div>`);
            $('#password-form')[0].reset();
            $('.password-strength-meter').css('width', '0');
          } else {
            $('#password-message').html(`<div class="alert alert-danger">${result.message}</div>`);
          }
        } catch (e) {
          $('#password-message').html('<div class="alert alert-danger">An error occurred while processing your request.</div>');
        }
      },
      error: function() {
        $('#password-message').html('<div class="alert alert-danger">An error occurred while updating your password.</div>');
      }
    });
  });
});
</script>

</body>
</html>

