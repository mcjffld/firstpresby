        <html>
        <head>
        </head>
        <body>

        <div>


        <h2>Sermon Archive Data</h2>

        <?php

        $sermondir = "/tmp/sermons";

        if(isset($_REQUEST['date']) && $_REQUEST['date']!="")
        {
         $date=($_REQUEST['date']);

         $pattern = '/^[\d\-]+$/';

        if (preg_match($pattern, $date,  $matches) === 1) {

        } else {
          unset ($date);
        }
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


        $action = "update";

        if(isset($_REQUEST['action']) && $_REQUEST['action']!="")
        {
         $action=($_REQUEST['action']);
        }


       if (isset($action) && $action === 'Delete' && isset($date)) {

            $con=mysqli_connect("sermonarchive.db.5959523.hostedresource.com","sermonarchive","Duffy2014!!","sermonarchive");
            
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $sql = "delete from sermon where sermon_date = '" . $date . "'";

            echo $sql . "<p/>";

            if (!mysqli_query($con,$sql)) {
                echo "Unable to delete sermon data<p/>";
            }
            } else if (isset($date) && isset($title)) {

            $con=mysqli_connect("sermonarchive.db.5959523.hostedresource.com","sermonarchive","Duffy2014!!","sermonarchive");
            
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $sql = "REPLACE INTO sermon (sermon_date, title, scripture, filename, note) VALUES ('" . $date . "','" . $title . "','" . $scripture . "','" . $filename . "','" . $note . "')";

            echo "<!-- " . $sql . "-->";

            if (!mysqli_query($con,$sql)) {
                echo "Unable to save sermon data<p/>";
            }

        }
        ?>

        </div>


            <table border="1">
                <tr><th>Date</th><th>Title</th><th>Scripture</th><th>Filename</th><th>Note</th><th colspan="2">Action</tr>

                <tr><form method=\"post\" action="save-sermon.php">
          <td><input type="date" name="date" >
          <td><input type="text" name="title" size="60" >
          <td><input type="text" name="scripture" >
          <td><input type="text" name="filename" size="40" >
          <td><input type="text" name="note" >
          <td colspan="2" align="center"><input type="submit" value="Add"/>
          
          </form>
          <tr>
        <?php

        $con=mysqli_connect("sermonarchive.db.5959523.hostedresource.com","sermonarchive","Duffy2014!!","sermonarchive");

        if (mysqli_connect_errno())
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

        $result = mysqli_query($con,"SELECT * FROM sermon order by sermon_date desc");


        while($row = mysqli_fetch_array($result))
          {
            ?>
          <tr><form method=\"post\" action="save-sermon.php">
          <td><input type="text" name="date" value="<?php echo $row['sermon_date'];?>">
          <td><input type="text" name="title" size="60" value="<?php echo $row['title'];?>">
          <td><input type="text" name="scripture" value="<?php echo $row['scripture'];?>">
          <td><input type="text" name="filename" size="40" value="<?php echo $row['filename'];?>">
          <td><input type="text" name="note" value="<?php echo $row['note'];?>">
          <td><input type="submit" value="Update"/>
          <td><input type="submit" name="action" value="Delete">
          </form>
          <tr>
          <?
          }

        mysqli_close($con);


        ?>


        </table>


        </body>
        </html>