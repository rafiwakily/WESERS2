<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rafi database</title>
</head>

<body>
    <?php

    include_once("credentials.php");
    $connection = mysqli_connect($servername, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ((isset($_GET["Username"])) && (isset($_GET["Password"]))) {

        $isUserThere = $connection->prepare("SELECT * FROM people WHERE Username=?");
        $isUserThere->bind_param("s", $_GET["Username"]);
        $isUserThere->execute();

        $result = $isUserThere->get_result();

        if ($result->num_rows === 1) {
            print "We are checking your password <BR>";
            $row = mysqli_fetch_assoc($result);
            print $row["PERSON_ID"];
            if ($row['Password'] === $_GET["Password"]) 
            {
                print "Ok.. you are successfully registered<br>";
            } 
        } else
         {

            print "Wrong password !";
         }
        }else 
{ 
            print "our username is not in our database !! please consider registering";
            ?> <a href="Signup.php">Go to the Signup page</a>
            <a href="login.php">Try again</a>
    
        <?php
}
    ?>

    <form action="login.php" method="get">
        username: <input type="text" name="Username"><br>
        password: <input type="text" name="Password">
        <input type="submit" value="login" name="login">
    </form>


</body>

</html>
<html>
<body>