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

        if ($result->num_rows > 0) {
            print "Your username does not exist! make sure that username and password match correctly !!<br>";
            $row = mysqli_fetch_assoc($result);
            if ($row['Password'] == $_GET["Password"]) {
                print "You have the correct password";
            } else {
                print "Nice try.. ";
            }
        } else {
            print "user does not exist/ password is wrong";
        }
    }
    $connection->close();

    ?>

    <form action="login.php" method="get">
        username: <input type="text" name="Username">
        password: <input type="text" name="Password">
        <input type="submit" value="login" name="login">
    </form>


</body>

</html>