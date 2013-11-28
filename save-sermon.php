        <html>
        <head>
        </head>
        <body>

        <div>


        <?php

        $sermondir = "/tmp/sermons";

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



        if (isset($date) && isset($title)) {
           $fnamedata = preg_replace("/(\d+)-(\d+)-(\d+)/", "$1$2$3_", $date);

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

            $filename = $fnamedata . $filename;

            $tmpname = $_FILES['mp3file']['tmp_name'];

            $error = $_FILES['mp3file']['error'];

            if (!$error) {

                if (move_uploaded_file ($tmpname , "$sermondir/$filename" )) {
                    $my_file = 'sermon-list.txt';
                    $filedata = file_get_contents($my_file);
                    $handle = fopen($my_file,'w+') or die('Cannot open file:  '.$my_file);
                    $data = $date . "#" . $title . "#" . $scripture . "#" . $filename . "#" . $note . "\n";
                    fwrite($handle, $data);
                    fwrite($handle, $filedata);
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

        <form action="save-sermon.php" enctype="multipart/form-data" method="POST">
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


            <table border="1">
                <tr><th>Date</th><th>Title</th><th>Scripture</th><th>Filename</th><th>Note</th></tr>
        <?php

        $file = fopen("sermon-list.txt", "r") or exit("Unable to open file!");

        while(!feof($file)) {

            $str = fgets($file);

            $data = str_getcsv($str, "#");

            if ($data[0] != NULL) { 

                if ($data[4] == NULL || $data[4] == "") {
                    $data[4]  ="&nbsp;";
                }
        ?>

<tr>
    <td><?= $data[0] ?></td>
    <td><?= $data[1] ?></td>
    <td><?= $data[2] ?></td>
    <td><?= $data[3] ?></td>
    <td><?= $data[4] ?></td>
</tr>

        <?php

            }
        }
        fclose($file);
        ?>


        </table>


        </body>
        </html>