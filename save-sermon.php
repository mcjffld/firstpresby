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
        } else {
            $scripture = "";
        }
        if(isset($_REQUEST['note']) && $_REQUEST['note']!="")
        {
         $note=($_REQUEST['note']);
        } else {
            $note = "";
        }
        if(isset($_REQUEST['mp3file']) && $_REQUEST['mp3file']!="")
        {
         $mp3file=($_REQUEST['mp3file']);
        } else {
            $mp3file = "";
        }



        if (isset($date) && isset($title)) {
            $my_file = 'sermon-list.txt';

            $data = $date . "#" . $title . "#" . $scripture . "#" . $mp3file . "#" . $note . "\n";

            $lines = file($my_file);

            array_unshift($lines,$data);

            rsort($lines);

            file_put_contents($my_file, implode(PHP_EOL, $lines));

        } else {

            echo "no form data found";
        }
        ?>

        <form action="save-sermon.php" method="POST">
        <table>
        <tr><th>Title</th><td><input type="text" name="title"/></td></tr>
        <tr><th>Scripture</th><td><input type="text" name="scripture"/></td></tr>
        <tr><th>Date</th><td><input type="date" name="date"/></td></tr>
        <tr><th>Note</th><td><input type="text" name="note"/></td></tr>
        <tr><th>MP3 Filename</th><td><input type="text" name="mp3file" id="mp3file"/></td></tr>
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

            if (isset($data[0])) {
                $date = $data[0];

                if (isset($data[1])) {
                    $title = $data[1];
                } else {
                    $title = "&nbsp;";
                }
                if (isset($data[2])) {
                    $scripture = $data[2];
                } else {
                    $scripture = "&nbsp;";
                }
                if (isset($data[3])) {
                    $filename = $data[3];
                } else {
                    $filename = "&nbsp;";
                }
                if (isset($data[4])) {
                    $note = $data[4];
                } else {
                    $note = "&nbsp;";
                }

        ?>

<tr>
    <td><?= $date ?></td>
    <td><?= $title ?></td>
    <td><?= $scripture ?></td>
    <td><?= $filename ?></td>
    <td><?= $note ?></td>
</tr>

        <?php

            }
        }
        fclose($file);
        ?>


        </table>


        </body>
        </html>