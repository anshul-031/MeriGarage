<?php


// Connect to the MySQL database
$username="showmeio_garagesoftware";
$password="GarageS0ftware2022#@";
$server="localhost";
$database="showmeio_garages_db22";

// Connect to the MySQL database
$conn = mysqli_connect($servername, $username, $password, $dbname);




$id = $_GET['id'];
$sql = "SELECT * FROM jobcard WHERE id='$id'";
$result = mysqli_query($conn, $sql);


// Check for any reminders that are due today
// $sql = "SELECT * FROM jobcard WHERE 'email' ";
// $result = mysqli_query($conn, $sql);

// Loop through the results and send out the reminder emails
while ($row = mysqli_fetch_assoc($result)) {
  $to = $row['email'];
  $subject = 'Service Reminder';
  // $message = 'Dear  ' . $row['name'] . ',      ' . $row['g_name'] . ',     this is a reminder that your service is due on    ' . $row['last_reminder_date'] . '.';





  $message = 'Dear  ' . $row['name'] . ',

    This is ' . $row['g_name'] . ', We wanted to remind you that it s time for your vehicle routine maintenance service. Our team of certified
    technicians is well-equipped to handle any service requirements your vehicle may need, We take pride in providing 
    top-notch service to all of our customers and want to ensure that your vehicle is in the best possible condition 


                                                                                            Best regards
                                                                                      ' . $row['g_name'] . '.';








  $headers = 'From: your_email@example.com';
  mail($to, $subject, $message, $headers);

  // Update the last reminder date in the database
  // $sql = "UPDATE jobcard SET last_reminder_date = NOW() WHERE id = " . $row['id'];
  // mysqli_query($conn, $sql);
}

// Close the MySQL connection
mysqli_close($conn);


  echo '<script type ="text/JavaScript">';  
            echo 'alert("Service Reminder Has Been Successfully Sent");';
            echo 'window.location= "ShowJobCard.php";';
            echo '</script>'; 

header("location:ShowJobCard.php");


?>