<html>
    <head>
        <meta charset = "utf-8">
        <title>Account Successful</title>
        <link rel = "stylesheet" href = "AccountSuccessful.css">
    </head>


    <body>
        <!-- bank logo -->
        <header>
            <meta name="viewport" content="width=device-width">
            <img id = "logo" src="logo.png"/>
        </header>


        <!-- gray bar -->
        <div id="graybar"></div>

        <!-- thank you message -->
        <div class="greeting">Thank you for opening an account with us!</div>

        <!-- details: account/routing number/types -->
        <!-- Remove hardcode numbers & type, values should be from the the database -->
        <!-- Values here just for demonstration -->
        <div class="details">
            <div class="detailsElement">Details:</div>
            <div class="detailsElement">Acccount Number: 123456789101112</div>
            <div class="detailsElement">Routing Number: 123456789101112</div>
            <div>Type: Savings</div>
        </div>


        <!-- homepage button -->
        <!-- replace '#' with url link to homepage -->
        <div class="homepageDiv">
            <button class="homepageButton" onclick="location.href='Balance/Balance/Balance.php'">Return to Homepage</button>
        </div>



    </body>
</html>
