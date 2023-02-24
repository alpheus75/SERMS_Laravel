<?php
// Check for the existence of longitude and latitude in our POST request
// variables; if they're present, continue attempting to save
if (isset($_POST['longitude']) && isset($_POST['latitude'])) {
  // Cast variables to float (never accept unsanitized input!)
  $longitude = (float) $_POST['longitude'];
  $latitude = (float) $_POST['latitude'];
  // For now, let's hard-code the user identifier to "1" -we can use PHP sessions and authentication to set this differently later on
  $user = $_SESSION['user'];
  // Set the timestamp from the current system time
  $time = time();
  // Put our query together:
  $sql = "INSERT INTO sos(sender, longitude, latitude, created_at, updated_at) VALUES ('$user', '$longitude', '$latitude',  CURRENT_TIMESTAMP(),  CURRENT_TIMESTAMP())";
  // Run the query, and return an error if it fails
  if (mysqli_query($conn, $sql)) {
    echo '<script language="javascript">';
    echo 'alert("SOS message received!");';
    echo 'window.location="dashboard.php";';
    echo '</script>';
    }else{
        echo '<script language="javascript">';
      echo 'alert("Could not receive the SOS, try again!");';
      echo 'window.location="dashboard.php";';
      echo '</script>';
    }

}