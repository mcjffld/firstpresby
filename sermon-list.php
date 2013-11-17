<html>
<head>
</head>
<body>

<div>


<?php

if(isset($_REQUEST['date']) && $_REQUEST['date']!="")
{
 $date=($_REQUEST['date']);
}
if(isset($_REQUEST['title']) && $_REQUEST['title']!="")
{
 $title=($_REQUEST['title']);
}
if(isset($_REQUEST['scripture']) && $_REQUEST['scripture']!="")
{
 $scripture=($_REQUEST['scripture']);
}
if(isset($_REQUEST['note']) && $_REQUEST['note']!="")
{
 $note=($_REQUEST['note']);
} else {
	$note = "";
}



	if (isset($date) && isset($title) && isset($scripture)) {

if ($_FILES["mp3file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["mp3file"]["error"] . "<br>";
  }
else
  {
  echo "Upload: " . $_FILES["mp3file"]["name"] . "<br>";
  echo "Type: " . $_FILES["mp3file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["mp3file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["mp3file"]["tmp_name"];
  }

		$filename = $_FILES['mp3file']['name'];

		$tmpname = $_FILES['mp3file']['tmp_name'];

		$error = $_FILES['mp3file']['error'];

		if (!$error) {
			if (move_uploaded_file ($tmpname , "/tmp/sermons/$filename" )) {
				$my_file = 'sermon-list.txt';
				$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
				$data = $date . "#" . $title . "#" . $scripture . "#" . $filename . "#" . $note . "\n";
				fwrite($handle, $data);

				echo "saved file to " . $filename . " for " . $title . " from " . $date;

			} else {
				echo "Couldn't copy the file from " . $tmpname . " to " . $filename;
			}
		} else {
			echo $error;
		}
	} else {
		echo "no form data found";
	}
?>

<form action="sermon-list.php" enctype="multipart/form-data" method="POST">
<table>
<tr><th>Title</th><td><input type="text" name="title"/></td></tr>
<tr><th>Scripture</th><td><input type="text" name="scripture"/></td></tr>
<tr><th>Date</th><td><input type="date" name="date"/></td></tr>
<tr><th>Note</th><td><input type="text" name="note"/></td></tr>
<tr><th>MP3</th><td><input type="file" name="mp3file" id="mp3file"/></td></tr>
<tr><th>&nbsp;</th><td><input type="submit"/></td></tr>
</table>
</form>

</div>

<div>
<?php

$file = fopen("/Users/mjames/Sites/fpc/sermon-list.txt", "r") or exit("Unable to open file!");

while(!feof($file)) {

	$str = fgets($file);

	$data = str_getcsv($str, "#");

	if ($data[0] != NULL) {	
?>

<div>

<?= $data[0] ?>
<span>
<a href="http://firstpresby.net/sermons/<?= $data[3] ?>"><?= $data[1] ?></a>
<br/>
<?= $data[2] ?>
<br/>
<?= $data[4] ?>
</span>


<p>

<?php

	}
}
fclose($file);
?>


</div>


</body>
</html>