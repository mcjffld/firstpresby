

<?php
$year = $_GET['year'];

if ($year == '' || strlen($year) != 4 || $year < 2008 || $year > 2020) {
    $year = date('Y');
}
?>

<div id="content">
<h1>Sermon Downloads</h1>
<img src="images/Rev Duffy - Preaching Close up smiling.jpg" />
<p>To download, right-click the link and select &quot;Save As&quot;.</p>
<h2> <? $year ?> Sermons</h2>
<p/>







<div>
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr class="style2">
    <td width="62" align="left" valign="top" class="style2" style="border-right:dotted 1px #333333">

<?php
if ($handle = opendir('sermons')) {

    $year = substr($year,2,4);
	
    $files = array();

    while (false != ($filename = readdir($handle))) {
        $files[] = $filename;
    }

    rsort($files);

    foreach ($files as $i => $file) {
	$part = substr($file, 0,2);
        if ($part == $year) {

preg_match('/(?<name>\w+): (?<digit>\d+)/', $str, $matches);

	    preg_match('/(?<year>\d\d)[\s_](?<month>\d\d)[\s_](?<day>\d\d)[\s_](?<name>.*)\.mp3/',$file,$matches);
	
	print(' <tr class="style2">');
        print(' <td width="62" align="left" valign="top" class="style2" style="border-right:dotted 1px #333333">');
            print($matches['month']);
	    print("/");
            print($matches['day']);
	    print("/");
            print($matches['year']);
	    print(' </td><td width="566" align="left" valign="top" class="style2">');
	    $matches['name'] = preg_replace('/_/',' ',$matches['name']);
	    print('&nbsp;&nbsp;<a href="');
            print('../sermons/');
            print($file);
	    print('">');
            print($matches['name']);
	    print('</a>');
	    print("</td></tr> ");
        }
    }
    closedir($handle);
}
?>


</table>
<br/>&nbsp;<br/>
<img src="images/Rev Duffy Breaking Bread.jpg" />
</div>
</div>
