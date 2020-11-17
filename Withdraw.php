<?php

// CONNECTING SERVER (FOR YOU TO EDIT) --------------------------------
// $serverEndpoint = 'mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com';
// $serverUserName = 'butteadmin';
// $serverPassword = 'buttecmpe131';
// $dbname = 'registration';
//
// // creating a new server connection using our preset AWS login values
// $mysqli = new mysqli($serverEndpoint, $serverUserName, $serverPassword, $dbname, 3306);
//
// // simple error catch if we are unable to connect to the MySQL Database
// if ($mysqli->connect_errno) {
//   echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
// }


$conn = mysqli_connect("localhost", "root", "", "moneytest");

if (!$conn)
{
  die("Connection failed: " . mysqli_connect_error());
}
// When you change this make sure it change Name to userName
$sql1 = "SELECT userCheckingAccountBalance FROM money WHERE Name = 'allen'";
$sql2 = "SELECT userSavingsAccountBalance FROM money WHERE Name = 'allen'";

$input = $_POST["amount"];
$typeAcc = $_POST["AccountNumber"];

if($typeAcc === 'Checking')
{
  $results1 = mysqli_query($conn,$sql1);
  $row1 = mysqli_fetch_assoc($results1);

  if($row1["userCheckingAccountBalance"] >= $input)
  {
    echo "success 1";
  }
  else if($row1["userCheckingAccountBalance"] < $input)
  {
    echo "failure 1";
  }
}
else if($typeAcc === 'Savings')
{
  $results2 = mysqli_query($conn,$sql2);
  $row2 = mysqli_fetch_assoc($results2);

  if($row2["userSavingsAccountBalance"] >= $input)
  {
    echo "success 2";
  }
  else if($row2["userSavingsAccountBalance"] < $input)
  {
    echo "failure 2";
  }
}

//END CONNECTION (MAKE SURE YOU UNCOMMENT THIS) -------------------
//  mysqli_close($mysqli);


?>

<html>
  <head>
    <link rel = "stylesheet" href = "Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">

    <title> Withdraw </title>

  </head>

  <body>

    <header>
        <img id = "logo" src="logo.png"/>
    </header>

    <div id="graybar">
    </div>

    <br>
    <!-- TITLE -->
    <center>

      <p class = regularFont>
        Withdraw
      </p>

      <p class = "regularFont">
        Put in value between 0.00 to 4000.00
      </p>

      <p class = "regularFont">


      <!-- SHOWS AMOUNT FOR USER -->
      Checking account: $
      <?php
        $results1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_fetch_assoc($results1);
        echo $row1["userCheckingAccountBalance"];
      ?>

      <br>

      Savings account: $
      <?php
        $results2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($results2);
        echo $row2["userSavingsAccountBalance"];
      ?>
      <br>
    </p>

    <!-- END =- -->
    </form>


    <!-- When you take out money -->
    <!-- ALSO CHECK DIRECTORY -->
    <form action="/Deposit_Withdraw1/atm-application/Withdraw.php" method="post">
      <p class = "regularFont">
      <label for="AccountNumber">Choose an account:</label>
      <select name="AccountNumber">
        <option value="null">--Choose--</option>
        <option value="Checking">Checking</option>
        <option value="Savings">Savings</option>
      </select>
    </p>


    <!-- PRINTS OUT ERRORS -->

    <?php
    //If user did not select account
    if($_POST["AccountNumber"] === "null")
    {
      echo '<span style="color:RED;text-align:center;">ERROR: You did not select which account.</span>';
    }
    //If user puts in more than account number
    // else if($_POST["amount"] === )
    // {
    //   echo '<span style="color:RED;text-align:center;">ERROR: The amount you entered is greater than the amount you have.</span>';
    // }

    ?>
    <!-- END PRINT ERROR -->



      <br>
      <br>
      <br>

      <input type = "number" name = "amount" min = "0.00" max = "4000.00" step = "0.01">
      <input type = "submit" value = "submit">
    </form>


      <br>

      <input type="submit" value = "Go Back">



    <center>
  </body>
<html>
