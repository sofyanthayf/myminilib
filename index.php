<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <Title>Entry New Book</Title>

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
    </style>

  </head>
  <body>

    <h1>Entri New Book</h1>

    <form method="post" action="index.php" enctype="multipart/form-data" >
      Title <input type="text" name="btitle" id="btitle"/></br></br>
      Author <br>
      Nama Depan <input type="text" name="a_name" id="a_name"/><br>
      Nama Belakang <input type="text" name="a_fam" id="a_fam"/></br></br>
      Publisher <input type="text" name="publisher" id="publisher"/></br></br>
      Year <input type="text" name="pubyear" id="pubyear"/></br></br>
      City <input type="text" name="pubcity" id="pubcity"/></br></br>
      Country <input type="text" name="pubcountry" id="pubcountry"/></br></br>
      <input type="submit" name="submit" value="Submit" />
      <input type="submit" name="load_data" value="Load Data" />
    </form>

  </body>
</html>
