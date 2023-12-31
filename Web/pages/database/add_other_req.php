<!--
  Purpose: Displays a success page after the user successfully submits a burial request.
           Adds a burial other request into the database's burial_other_requests table.

  Authors: 
  Ben Le: Created the structure of the HTML (contact_success.html)
  Matthew MacNeil: Added PHP code into the body
-->
<!-- Document declaration -->
<!DOCTYPE html>

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
/>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Link Icon for browser tab -->
    <link
      rel="icon"
      href="https://i.ibb.co/PWqTJvM/logo-Icon.png"
      type="image/x-icon"
    />

    <!-- Link bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <!--Linking the css files for styling-->
    <link rel="stylesheet" href="../../styles/body.css" />
    <link rel="stylesheet" href="../../styles/burial_request_success.css" />
    <link rel="stylesheet" href="../../styles/nav.css" />
    <link rel="stylesheet" href="../../styles/header.css" />
    <link rel="stylesheet" href="../../styles/footer.css" />
    <link rel="stylesheet" href="../../styles/dropdown.css" />

    <!--Linking custom fonts-->
    <link
      rel="stylesheet"
      href="path/to/font-awesome/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <!-- Linking javascript files for bootstrap -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>

    <!--Linking the javascript files for functionality-->
    <script src="../../scripts/estore.js" async></script>
    <script defer src="../../scripts/main.js" async></script>
    <script src="../../scripts/contact.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"
    ></script>

    <title>Woodland Conservation</title>
  </head>

  <body>
    <header>
      <div class="header-container">
        <div class="org-name">
          <!--Links back to homepage if clicked-->
          <a class="org-logo" href="../../index.html"
            ><img src="https://i.ibb.co/GvF71Pz/logo.png"
          /></a>
        </div>
        <div class="menu-btn">
          <div class="menu-btn_burger"></div>
          <div id="nav-bar" class="nav-bar">
            <nav>
              <ul>
                <!--Links to alternative pages in the navbar-->
                <div class="dropdown">
                  <li>
                    <a class="dropbtn" href="../../pages/about/about.html"
                      >About</a
                    >
                  </li>
                  <div class="dropdown-content">
                    <a href="../../pages/about/about.html" class="dropdown-top"
                      >About Woodland</a
                    >
                    <a href="../../pages/about/news.html">News</a>
                    <a href="../../pages/about/faq.html">FAQ</a>
                    <a
                      href="../../pages/about/contact.html"
                      class="dropdown-bottom"
                      >Contact Us</a
                    >
                  </div>
                </div>

                <div class="dropdown">
                  <li>
                    <a class="dropbtn" href="../../pages/burial/burial.html"
                      >Burial</a
                    >
                  </li>
                  <div class="dropdown-content">
                    <a href="#" class="dropdown-top">About Burial</a>
                    <a href="#" class="dropdown-bottom">Request Burial</a>
                  </div>
                </div>

                <li>
                  <a href="../../pages/e-commerce/estore.html">Marketplace</a>
                </li>

                <li>
                  <a href="../../pages/newmap/client/index.html">Map</a>
                </li>

                <div class="dropdown">
                  <li>
                    <a
                      class="dropbtn"
                      href="../../pages/newmap/client/conservation.html"
                      >Gallery</a
                    >
                  </li>
                  <div class="dropdown-content">
                    <a
                      href="../../pages/newmap/client/conservation.html"
                      class="dropdown-top"
                      >Photo Gallery</a
                    >
                    <a
                      href="../../pages/newmap/admin/index.html"
                      class="dropdown-bottom"
                      >Upload a Photo</a
                    >
                    <a
                      href="../../pages/ecosystem/ecosystem.html"
                      class="dropdown-bottom"
                      >Ecosystem</a
                    >
                  </div>
                </div>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>

    <!--Main content div for all page content for responsive design-->

    <div class="main-content">
      <div class="success-page">
             
<?php
// Fields for the person who is making the burial request
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$number = $_POST["phone"];
$rel = $_POST["relationship"]; // stores the relationship of the requester and loved one

// Fields for the person who the burial request is for
$fname2 = $_POST["fname-2"];
$lname2 = $_POST["lname-2"];

// Date the request was made
$current_date = date("Y-m-d");

// Read in database variables
require("../../pages/database/mysqldb_group24A.php");

// The table that the burial request will be stored into
$table = "burial_other_requests";

// Try to connect to MySQL
$link = mysqli_connect($dbLocation, $dbUsername, $dbPassword);
if (!$link) die("Couldn't connect to MySQL"); // Print error message if connection is unsuccessful

// Switch to the database
mysqli_select_db($link, $dbName)
        or die("Couldn't open $dbName: ".mysqli_error($link)); // Print error message if selecting db is unsuccessful

// Create the query to insert the user's request into the db
$query = "INSERT INTO $table (req_fname, req_lname, req_email, req_phone, relationship, oth_fname, oth_lname, req_date) VALUES";
$query .= " (\"$fname\", \"$lname\", \"$email\", \"$number\", \"$rel\", \"$fname2\", \"$lname2\", '$current_date')";

$ok = mysqli_query($link, $query); // True only if query was successful

// Check if the insertion of data was not successful
if (!$ok) {
    print "Sorry your request was not stored properly in our database.";
} else {
    // Display success page
    echo '<img class="check" src="https://i.ibb.co/sKKdxnk/checkmark.png" />';
    echo '<h1 class="success-title">Success</h1>';
    echo '<img class="bar" src="https://i.ibb.co/CH6Cmcp/gold-bar.png" />';
    echo '<h3>We have received your request.<br />We will get back to you shortly.</h3>';
}

// Close the connection to the database
mysqli_close($link);
?>

</div>
      <!--The footer for our webpage-->
      <footer class="section-p1">
        <div class="col">
          <h4>Contact Us</h4>
          <p>
            <strong>Address:</strong> 71 St Pauls Ln, French Village, NS B3Z 4E3
          </p>
          <p><strong>Phone:</strong> 111 222 333/ (+1) 444 555 666</p>
          <p><strong>Hours:</strong> 10:00 - 16:00; Mon - Sat</p>
        </div>

        <!--links to alternative pages on website-->
        <div class="col">
          <h4>Useful Links</h4>
          <a href="#">Sign-in</a>
          <a href="pages/e-commerce/estore.html">Marketplace</a>
          <a href="pages/map/map.html">Map</a>
        </div>

        <div class="col">
          <div class="follow">
            <h4>Follow us</h4>
            <div class="icon">
              <i class="fab fa-facebook-f"></i>
              <i class="fab fa-twitter"></i>
              <i class="fab fa-instagram"></i>
              <i class="fab fa-pinterest-p"></i>
              <i class="fab fa-linkedin"></i>
            </div>
          </div>
        </div>

        <div class="copyright">
          <p>Ⓒ SMU Software Engineering Group F</p>
        </div>
      </footer>
    </div>
  </body>
</html>