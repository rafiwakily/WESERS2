<?php
include_once "sessionCheck.php";
include_once "credentials.php";
include_once "displayUser.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Products</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='2tpife.css'>
</head>

<body>
  <script>
    window.onscroll = function() {
      myFunction()
    };
    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
  </script>
  <nav id="navigationBar">
    <div id="navigationTittle">
      <h1></h1>
    </div>
    <div id=navigationLinks>
      <a href="2tpifeHome.php">
        <h1>Home</h1>
        <a href="2tpifeProducts.php">
          <h1>Products</h1>
        </a>
        <a href="2tpifeAbout.php">
          <h1>About</h1>
        </a>
    </div>

    <div id="login">
      <?php if (isset($_POST["Logout"])) {

        session_unset();
        session_destroy();
        print "You have been logged out successfully";

        /*  ?> <a href="2tpifeProducts.php">Login</a><?php */
      ?>
        <form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="post">
          <div>
            <div>
              <label for="Username">Username: </label>
              <input type="text" name="Username" placeholder="Username" required>
            </div>
            <div>
              <label for="Password">Password: </label>
              <input type="password" name="Password" placeholder="Password" required>
            </div>
          </div>
          <input type="submit" name="Login" id="loginButton" value="Login">
        </form>
        <?php
        $bDisplaySignup = false;
        if (!isset($_SESSION["UserLogged"])) {
          $bDisplaySignup = true;
        } elseif (!$_SESSION["UserLogged"]) {
          $bDisplaySignup = true;
        }

        if ($bDisplaySignup) { ?>
          <div id="Signup"><a href="Signup.php">Signup</a></div>
          <?php }
      } elseif ($_SESSION["UserLogged"]) {
        //print "You have already been logged-in" . "<br>";
        displayUserDetails($connection);
      } elseif (isset($_POST["Username"]) && isset($_POST["Password"])) {
        $userFromMyDatabase = $connection->prepare("SELECT * FROM ppl WHERE UserName=?");
        $userFromMyDatabase->bind_param("s", $_POST["Username"]);
        $userFromMyDatabase->execute();
        $result = $userFromMyDatabase->get_result();
        if ($result->num_rows === 1) {
          print "You have been successfully logged-in " . "<br>";
          $row = $result->fetch_assoc();
          if (password_verify($_POST["Password"], $row["Password"])) {
            $_SESSION["UserLogged"] = true;
            $_SESSION["CurrentUser"] = $row["PERSON_ID"];
            displayUserDetails($connection);
          } else {
            print "Password mismatched ! Please type your password correctly"; ?>
            <a href="2tpifeProducts.php">Try again to login</a><?php
                                                              }
                                                            } else {
                                                              print "The username you typed has not been found in our database !!"; ?>
          <a href="Signup.php">Please register first</a> <br>
          <a href="2tpifeProducts.php">Try again to login</a>
        <?php
                                                            }
                                                          } else {
        ?>
        <form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="post">
          <div>
            <div>
              <label for="Username">Username: </label>
              <input type="text" name="Username" placeholder="Username" required>
            </div>
            <div>
              <label for="Password">Password: </label>
              <input type="password" name="Password" placeholder="Password" required>
            </div>
          </div>
          <input type="submit" name="Login" id="loginButton" value="Login">
        </form>
      <?php
                                                          } ?>
    </div>

    <?php if (isset($_SESSION["UserLogged"])) {
      if (!$_SESSION["UserLogged"]) { ?>
        <div id="Signup"><a href="Signup.php">Signup</a></div>
    <?php }
    } ?>
    <div id="navigationLanguage">
      <a href="">Language</a>
    </div>
  </nav>
  <h1>R&W Automobile</h1>
  <h1>In this website you can find your dream cars </h1>
  <form action="/action_page.php" target="_blank">
    <input class="w3-input w3-border" type="text" placeholder="Mark" required name="Mark">
    <input class="w3-input w3-section w3-border" type="text" placeholder="Model" required name="Model">
    <input class="w3-input w3-section w3-border" type="text" placeholder="Price" required name="Price">
    <button class="w3-button w3-black w3-section" type="submit">
      <i class="fa fa-paper-plane"></i> Find</button>
  </form>
  <br>

  <img src="logo2.jpg" alt="Paris" class="center">

  <br>
  <hr>

  <div class="footer">
    <h1>Copyright 2020</h1>
  </div>
  </div>
</body>

</html>