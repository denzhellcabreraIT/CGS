<?php
session_start();

// Check if user is logged in and is a teacher
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['account_type'] !== 'teacher') {
    // Store the current URL in a session variable so we can redirect back after login
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    
    // If user is logged in but not a teacher, redirect to appropriate home page
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        if ($_SESSION['account_type'] === 'admin' || $_SESSION['account_type'] === 'staff') {
            header("Location: /admin/admin_dashboard.php");
        } else {
            header("Location: /Home.php");
        }
    } else {
        // Not logged in, redirect to login page
        header("Location: /ACCOUNTS/Login.php");
    }
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mental Health Support</title>
  <link rel="stylesheet" href="home.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
    <a href="/services/report_student.php">Report a student</a>
    <a href="/appointment">Appoint counseling session</a>
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
          <span class="welcome">Welcome, Teacher <?php echo $_SESSION['username']; ?>!</span>
          <a href="/services/user_settings.php" class="btn settings-btn"><i class="fas fa-cog"></i> Settings</a>
          <a href="/ACCOUNTS/Logout.php" class="btn">Logout</a>
        </div>
      <?php else: ?>
        <a href="/ACCOUNTS/Login.php" class="btn">Login</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

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

</body>
</html>
