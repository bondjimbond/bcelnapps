<?php
$con=mysqli_connect(localhost,"bceln_swamped","swamped","bceln_drupal");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM aadrupal_swamped_button");

echo "<table border='1'><tr><th>Timestamp</th><th>Email address</th><th>Action</th></tr>";

while($row = mysql_fetch_array($result)){
    print "<tr><td>".$row['datetime']."</td><td>".$row['email_address']."</td><td>".$row['action_type']."</td></tr>";
}
print "</table>";

mysqli_close($con);
?>