
<?php

$date = $_REQUEST('date');
$title = $_REQUEST('title');
$scripture = $_REQUEST('scripture');
$note = $_REQUEST('note');


$filename = $_FILES['userfile']['name']

$tmpname = $_FILES['userfile']['tmp_name']

$error = $_FILES['userfile']['error']

if (!$error) {
	if (move_uploaded_file ($tmpname , "/tmp/sermons/$filename" )) {
$my_file = 'sermon-list.txt';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
$data = $date . "#" . $title . "#" . $scripture . "#" . $filename . "#" . $note . "\n";
fwrite($handle, $data);


} else {

}
} else {


echo $error 
}


?>
