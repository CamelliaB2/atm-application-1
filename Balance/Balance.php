<?php

session_start();
unset($_SESSION["entryValue"]);
unset($_SESSION["inputValue"]);
unset($_SESSION["ordernumber"]);
unset($_SESSION["amount"]);

if( ! empty($_SESSION['error']))
{
  
  echo "<script>";
   echo "alert('You do not have a checking account on file. Please open one before proceeding with the transaction.');";
   echo "</script>";
  unset($_SESSION['error']);
}

if( ! empty($_SESSION['errorTwo']))
{
 
  echo "<script>";
   echo "alert('You do not have a savings account on file. Please open one before proceeding with the transaction.');";
   echo "</script>";
  unset($_SESSION['errorTwo']);
}

if( ! empty($_SESSION['errorThree']))
{

  echo "<script>";
   echo "alert('Checking Account Already Existed.');";
   echo "</script>";
  unset($_SESSION['errorThree']);
}

if( ! empty($_SESSION['errorFour']))
{

  echo "<script>";
   echo "alert('Savings Account Already Existed.');";
   echo "</script>";
  unset($_SESSION['errorFour']);
}



// these are our login values associated with the AWS
    // database instance, found here:
    // https://us-west-1.console.aws.amazon.com/rds/home?region=us-west-1#database:id=mysqldb;is-cluster=false
    $serverEndpoint = 'mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com';
    $serverUserName = 'butteadmin';
    $serverPassword = 'buttecmpe131';
    $dbname = 'registration';

    // creating a new server connection using our preset AWS login values
    $mysqli = new mysqli($serverEndpoint, $serverUserName, $serverPassword, $dbname, 3306);

    // simple error catch if we are unable to connect to the MySQL Database
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    // test display of host connection info
    // echo $mysqli->host_info . "\n";

    $user = $_SESSION['userName'];

    $setBalance = "SELECT userCheckingAccountBalance FROM userRegistration WHERE userName = '{$_SESSION['userName']}' ";
    $setSaving = "SELECT userSavingsAccountBalance FROM userRegistration WHERE userName = '{$_SESSION['userName']}' ";

    $results = mysqli_query($mysqli, $setBalance);
    $results2 = mysqli_query($mysqli, $setSaving);

    $row = mysqli_fetch_assoc($results);
    $row2 = mysqli_fetch_assoc($results2);

    $balance = $row['userCheckingAccountBalance'];
    $saving = $row2['userSavingsAccountBalance'];

?>






<html>
    <head>
        <meta charset = "utf-8">
        <title>Balance</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "Balance.css?v=<?php echo time(); ?>">
    </head>





    <body>
        <!-- bank logo -->
        <header>
          <div id="top">
            <meta name="viewport" content="width=device-width">
            <img id = "logo" src="logo.png"/>
           <a id="logoutbutton" href="logout.php">Logout</a>

  </div>

        </header>



        <!-- gray bar -->
        <div id="graybar"></div>

        <!-- deposit/withdraw & transfer & open account nagivations/
          empty divs are for layout purposes -->
        <nav id="nav_layout">
        <div id="column"></div>
        <div id="column"></div>


        <div id="column"><a class="nav_column" href="../PinPages/EnterPin2.php">Deposit/Withdrawal</a></div>

        <div id="column"><a class="nav_column" href="../PinPages/EnterPin.php">Send Money</a></div>


        <div id="column"><a class="nav_column" href="../PinPages/EnterPin3.php">Open/Close Account</a></div>


        <div id="column"></div>
        <div id="column"></div>
        </nav>

        <section class="sectionLayout">
            <!-- Checking Accounts -->
            <!-- Replace hard coded balance with php code -->
            <div class="barLayout">Checking Accounts</div>
            <div class="contentLayout">
                <div class="availableBalance">

                  <?php
                  // prints user's saving
                    if($balance === '0')
                    {
                      echo "$0.00";
                    }
                    else
                    {
                      $toString = "{$balance}";
                      if($toString === "")
                      {
                        echo "Account Not created";
                      }


                      else if(strpos($toString, '.') === false)
                      {
                        echo '$ ';

                        echo "{$balance}.00";
                      }
                      else
                      {
                        echo '$ ' + $balance;
                      }
                    }

                  ?>


                    <br>
                    <a style="font-size: 50%;">Available Balance</a>
                </div>
                <div class="transferMoney"><a href="../PinPages/EnterPin5.php">Transfer Funds to Savings</a></div>
                <div class="transferMoney"><a href="../Account_Info/CheckingAccountInfo.php">Account Info</a></div>
            </div>


            <br>
            <!-- Savings Accounts -->
            <!-- Replace hard coded balance with php code -->
            <div class="barLayout">Savings Accounts</div>
            <div class="contentLayout">
                <div class="availableBalance">

                  <?php
                  // prints user's saving
                    if($saving === '0')
                    {
                      echo "$0.00";
                    }
                    else
                    {

                      $toString = "{$saving}";

                      if($toString === "")
                      {
                        echo "Account Not created";
                      }
                      else if(strpos($toString, '.') === false)
                      {
                        echo '$ ';
                        echo "{$saving}.00";
                      }
                      else
                      {
                        echo '$ ' + $saving;
                      }
                    }


                  ?>


                    <br>
                    <a style="font-size: 50%;">Available Balance</a>
                </div>
                <div class="transferMoney"><a href="../PinPages/EnterPin4.php">Transfer Funds to Checking</a></div>
                <div class="transferMoney"><a href="../Account_Info/SavingsAccountInfo.php">Account Info</a></div>
            </div>



            <br>
            <!-- Transaction History -->
            <!-- Replace # in href tag to go to your page Allen -->
            <div class="barLayout">Transactions History</div>
            <div class="contentLayout">
                <div id = "history" >Complete history ready to view: <a href="../History/History.php">Complete History</a></div>



            </div>


        </section>
        <center>
          <!-- Logout -->
          <!-- <button  onclick="return logout();" >Logout</button> -->
      </center>
    </body>
</html>
