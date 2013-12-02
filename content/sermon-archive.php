
<?php
if(isset($_REQUEST['year']) && $_REQUEST['year']!="") {
	$year=($_REQUEST['year']);
} else {
	$year = date("Y");
}
?>
<html> 
<head> 

	<style type="text/css">

.sermon {
	margin-left: 10px;
	border-top: 1px;
	vertical-align: top;
	font-family: Georgia, "Times New Roman", Times, serif;
line-height: 1.4em;

}

li .sermon {
	color: red;
	margin-bottom: 10px;
}

.sermon .details {
	width: 400px;
}
.sermon .scripture {
	font-size: .9em;
	font-style: italic;
}

.sermon .date {
font-size: .9em;
	padding-left: 10px;
	padding-right: 10px;
	border-right:dotted 1px #333333;
}
	</style>
</head> 
<body>

<div id="content">
<h1><?=$year?> Sermon Archive</h1>

<p>To download, right-click the link and select &quot;Save As&quot;.</p>


			<table>

<?php

$file = fopen("sermon-list.txt", "r") or exit("Unable to open file!");

while(!feof($file)) {

	$str = fgets($file);

	$data = str_getcsv($str, "#");

	if ($data[0] != NULL) { 
		$date = $data[0]; 
		$title = $data[1]; 
		$scripture = $data[2]; 
		$filename = $data[3]; 
		$note = $data[4];

		$pattern = "/^" . $year . ".*/";

		if (preg_match($pattern, $date)) {

			$date = preg_replace("/(\d+)-(\d+)-(\d+)/", "$2/$3/$1", $date);

?>
	            <tr class="sermon"><td class="sermon date"><?= $date?></td> 
	            	<td class="sermon details">
	            	<span class="sermon link">
	            		<a href="/sermons/<?= $filename?>"><?=$title?></a> 
	            		<?= $note?></span>           <br/>          
	            	<span class="sermon scripture"><?=$scripture ?></span>
	            </td>
				</tr>
<?php
		}
    } 
} 

fclose($file); 

?>                 
			</table>

		</div>


	</body> 
<html>
