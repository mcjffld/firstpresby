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
        if(isset($_REQUEST['filename']) && $_REQUEST['filename']!="")
        {
         $filename=($_REQUEST['filename']);
        } else {
            $filename = "";
        }



        if (isset($date) && isset($title)) {

            $con=mysqli_connect("sermonarchive.db.5959523.hostedresource.com","sermonarchive","Duffy2014!!","sermonarchive");
            
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $sql = "INSERT INTO sermon (sermon_date, title, scripture, filename, note) VALUES ('" . $date . "','" . $title . "','" . $scripture . "','" . $filename . "','" . $note . "')";

            echo $sql . "<p/>";

            if (!mysqli_query($con,$sql)) {
                echo "Unable to save sermon data<p/>";
            }

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
        <tr><th>MP3 Filename</th><td><input type="text" name="filename"/></td></tr>
        <tr><th>&nbsp;</th><td><input type="submit"/></td></tr>
        </table>
        </form>

        </div>


            <table border="1">
                <tr><th>Date</th><th>Title</th><th>Scripture</th><th>Filename</th><th>Note</th></tr>
        <?php

        $con=mysqli_connect("sermonarchive.db.5959523.hostedresource.com","sermonarchive","Duffy2014!!","sermonarchive");

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
          echo "<td>" . $row['scripture'];
          echo "<td>" . $row['filename'];
          echo "<td>" . $row['note'];
          echo "<tr>";
          }

        mysqli_close($con);


        ?>


        </table>


        </body>
        </html>