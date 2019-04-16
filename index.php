<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <Title>MyMiniLib - Entry New Book</Title>

    <style type="text/css">
      body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
      }
      h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
      h1 { font-size: 2em; }
      h2 { font-size: 1.75em; }
      h3 { font-size: 1.2em; }
      table { margin-top: 0.75em; }
      th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
      td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
      td.datafields { text-align: right;}
    </style>

  </head>
  <body>

    <h1>Entri New Book</h1>

    <form method="post" action="index.php" enctype="multipart/form-data" >
      <table>
        <tr>
          <td class="datafields">Title:</td>
          <td><input type="text" name="btitle" id="btitle" width="50"/></td>
        </tr>
        <tr>
          <td class="datafields">Author:</td>
          <td>
            Nama Depan <input type="text" name="a_name" id="a_name"/><br>
            Nama Belakang <input type="text" name="a_fam" id="a_fam"/>
          </td>
        </tr>
        <tr>
          <td class="datafields">Publisher:</td>
          <td><input type="text" name="publisher" id="publisher" width="50"/></td>
        </tr>
        <tr>
          <td class="datafields">Year:</td>
          <td><input type="text" name="pubyear" id="pubyear"/></td>
        </tr>
        <tr>
          <td class="datafields">City:</td>
          <td><input type="text" name="pubcity" id="pubcity"/></td>
        </tr>
        <tr>
          <td class="datafields">Country:</td>
          <td><input type="text" name="pubcountry" id="pubcountry"/></td>
        </tr>
      </table>
      <br><br>
      <input type="submit" name="submit" value="Submit" />
      <input type="submit" name="load_data" value="Load Data" />
    </form>

    <?php
        $host = "tcp:sofyandb.database.windows.net,1433";
        $user = "dbadmin";
        $pass = "DicodingDicoding19";
        $db = "myminilib";
        try {
            $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }

        if (isset($_POST['submit'])) {
            try {
                $title = $_POST['btitle'];
                $author_name = $_POST['a_name'];
                $author_fam = $_POST['a_fam'];
                $publisher = $_POST['publisher'];
                $pubyear = $_POST['pubyear'];
                $pubcity = $_POST['pubcity'];
                $pubcountry = $_POST['pubcountry'];

                // Insert data
                $sql_insert = "INSERT INTO Books (title, a_name, a_fam, publisher, pubyear, pubcity, pubcountry )
                               VALUES (?,?,?,?,?,?,?)";

                $stmt = $conn->prepare($sql_insert);
                $stmt->bindValue(1, $title);
                $stmt->bindValue(2, $author_name);
                $stmt->bindValue(3, $author_fam);
                $stmt->bindValue(4, $publisher);
                $stmt->bindValue(5, $pubyear);
                $stmt->bindValue(6, $pubcity);
                $stmt->bindValue(7, $pubcountry);

                $stmt->execute();

            } catch(Exception $e) {
                echo "Database Failed: " . $e;
            }
            echo "<h3>New book item added.</h3>";

        } else if (isset($_POST['load_data'])) {

            try {
                $sql_select = "SELECT * FROM Books";
                $stmt = $conn->query($sql_select);
                $books = $stmt->fetchAll();
                if(count($books) > 0) {
                    echo "<h2>Book Collection:</h2>";
                    echo "<table>";
                    echo "<tr><th>Title</th>";
                    echo "<th>Author</th>";
                    echo "<th>Publisher</th>";
                    echo "<th>Year</th></tr>";
                    foreach($books as $book) {
                        $auth = "";
                        if( $book['a_fam']!=='' ) $auth .= $book['a_fam'] . ", ";
                        $auth .= $book['a_name'];

                        $publ = $book['publisher'];
                        if( $book['pubcity']!=='' ) $publ .= ", " . $book['pubcity'];
                        if( $book['pubcountry']!=='' ) $publ .= ", " . $book['pubcountry'];

                        echo "<tr><td>". $book['title'] ."</td>";
                        echo "<td>". $auth ."</td>";
                        echo "<td>". $publ ."</td>";
                        echo "<td>". $book['pubyear'] ."</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<h3>No books yet.</h3>";
                }
            } catch(Exception $e) {
                echo "Database Failed: " . $e;
            }
        }
     ?>
  </body>
</html>
