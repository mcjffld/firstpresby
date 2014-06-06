
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
.sermon .note {
	font-size: .75em;
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




$con=mysqli_connect("sermonarchive.db.5959523.hostedresource.com","sermonarchive","Duffy2014!!","sermonarchive");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM  sermon order by sermon_date desc");

while($row = mysqli_fetch_array($result)) {
		$date = $row['sermon_date']; 
		$date = mysqli_real_escape_string($con, $date);
		$title = $row['title']; 
		$title = mysqli_real_escape_string($con, $title);
		$scripture = $row['scripture']; 
		$scripture = mysqli_real_escape_string($con, $scripture);
		$filename = $row['filename']; 
		$filename = mysqli_real_escape_string($con, $filename);
		$note = $row['note'];
		$note = mysqli_real_escape_string($con, $note);

		$pattern = "/^" . $year . ".*/";

		if (preg_match($pattern, $date)) {

			$date = preg_replace("/(\d+)-(\d+)-(\d+)/", "$2/$3/$1", $date);

?>
	            <tr class="sermon"><td class="sermon date"><?= $date?></td> 
	            	<td class="sermon details">
	            	<span class="sermon link">
	            		<?php if ($filename) {?>
	            		<a href="<?= $filename?>">	
	            		<?php } ?>
	            		<?=$title?>
	            		<?php if ($filename) {?>
		            	</a> 
	            		<?php } ?>
	            	</span>           <br/>          
	            	<span class="sermon scripture"><?=$scripture ?></span><br/>
            		<span style="sermon note"><?= $note?></span>
	            </td>
				</tr>
<?php
		}
} 

mysqli_close($con);


?>                 
			</table>

		</div>


	</body> 
<html>
