<?php

session_start();


$serverEndpoint = 'mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com';
$serverUserName = 'butteadmin';
$serverPassword = 'buttecmpe131';
$dbname = 'registration';


//create connection
$conn = new mysqli($serverEndpoint, $serverUserName, $serverPassword, $dbname, 3306);

$name = $_SESSION['userName'];

//check connection
if (!$conn)
{
  die("Connection failed: " . mysqli_connect_error());
}

//counts number of rows
$sql1 = "SELECT COUNT(*) filePath FROM checkDeposit where userName = '$name'";
$results1 = mysqli_query($conn,$sql1);
$max = mysqli_fetch_assoc($results1);
//puts results into an array
$sql = "SELECT filePath,typess,amount,accountType FROM checkDeposit where userName = '$name'";
$results = mysqli_query($conn,$sql);
$rows = array();

while($row = mysqli_fetch_assoc($results))
{
  $rows[] = $row;
}

print_r($rows);

?>

<html>
  <head>
    <link rel = "stylesheet" href = "Style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">

    <title> Deposit </title>

    <style>

    table, td
    {
      border: 1px solid black;
    }

    </style>


  </head>

  <body>

    <header>
        <img id = "logo" src="logo.png"/>
    </header>

    <div id="graybar">
    </div>

    <br><br>
    <!-- TITLE -->
<center>

<br>

This is your transaction so far.

<br><br>

<br>



<!-- Sets up table -->

<table id="myTable">
  <tr>
    <td>Order Number</td>
    <td>Account Type</td>
    <td>Type</td>
    <td>Amount</td>
  </tr>
</table>

<br>
<br><br>

<button onclick = "window.location = '../Balance/Balance.php';">Go Back</button>
</center>
</body>
</html>




<script type = 'text/javascript'>

var rows = <?php echo json_encode($rows); ?>;


var counter = 0;
var max = "<?php echo $max["filePath"]; ?>";

while(parseInt(max) > counter)
{

  var table = document.getElementById("myTable");
  var row = table.insertRow(1);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);


  cell1.innerHTML = "#"+rows[counter]['filePath'];
  cell2.innerHTML = rows[counter]['accountType'];
  cell3.innerHTML = rows[counter]['typess'];
  cell4.innerHTML = '$ ' + rows[counter]['amount'];

  counter = counter + 1;
}

</script>
