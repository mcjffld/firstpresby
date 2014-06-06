<table>
<?php
$con=mysqli_connect("sermonarchive.db.5959523.hostedresource.com","sermonarchive","Duffy2014!!","sermonarchive");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM sermon");


while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['sermon_date'];
  echo "<td>" . $row['title'];
  echo "<td>" . $row['filename'];
  echo "<td>" . $row['scripture'];
  echo "<td>" . $row['note'];
  echo "<tr>";
  }

mysqli_close($con);

?>
</table>
