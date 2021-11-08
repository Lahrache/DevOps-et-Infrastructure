<html>
<body>

  <form method="POST" action="?">
    <br>
    <center>
      <input type="text" name="txt" placeholder="Text Here" />
      <input type="submit" value="Submit" />
    </center>
  </form>

</body>
</html>

<?php

$servername = "10.0.0.20";
$username = "newuser";
$password = "12345";
$dbname = "test2";

$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

if( isset($_POST['txt']) ) {
  $reponse = "INSERT INTO table2 (text, date) VALUES ('".$_POST["txt"]."', now())";
  $bdd->query($reponse);
}

$result = "SELECT * FROM table2 ORDER BY id desc LIMIT 10";
$result_res = $bdd->query($result);

$bdd->connection = null; // important de tjr se déco de la BDD après usage !!!!

if($result_res)
{
  echo '<table width="50%" border="1" cellpadding="5" cellspacing="5"
  <tr>
  <td><center> NAME </center></td>
  <td><center> DATE </center></td>
  </tr>
  ';
  while($row = $result_res->fetch(PDO::FETCH_OBJ))
  {
    echo '  <tr>
    <th> '.$row->text.' </th>
    <th> '.$row->date.' </th>
    </tr>
    ';
  }
}

?>