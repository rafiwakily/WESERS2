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

        $isUserThere = $connection->prepare("SELECT * FROM ppl WHERE Username=?");
        $isUserThere->bind_param("s", $_GET["Username"]);
        $isUserThere->execute();

        $result = $isUserThere->get_result();

        if ($result->num_rows > 0) {
            print "You DO exist in our DATABASE. We will check next if your password is correct !!<br>";
            $row = mysqli_fetch_assoc($result);
            if ($row['Password'] == $_GET["Password"]) {
                print "You have the correct password";
            } else {
                print "Nice try, you hacker ... ";
            }
        } else {
            print "You do not EXIST for us";
        }
    }
    $connection->close();

    ?>
    <table>
        <form action="login_page.php" method="get">
            <tr>
                <td> username: <input type="text" name="Username"></td>
            </tr>
            <tr>
                <td> password: <input type="text" name="Password"></td>
            </tr>
            <tr>
                <td><input type="submit" value="login" name="login"></td>
            </tr>
        </form>

    </table>
</body>

</html>