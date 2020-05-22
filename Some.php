<!DOCTYPEhtml>
<htmllang="en">
<head>
<metacharset="UTF-8">
<metaname="viewport"content="width=device-width, initial-scale= 1.0">
<title>Show User</title>
</head>
<body>
<?phpinclude_once"credentials.php";?>
<formaction="showUsers.php"name="form"method="post">
<selectname="selection">
<?php
$users = 0;
$displayUsers = $connection->prepare("SELECT*FROM ppl");
$displayUsers->execute();
$result = $displayUsers->get_result();
while ($row = $result->fetch_assoc()) {
$users++; ?>
<optionvalue="<?php
print$row["PERSON_ID"] .'" ';
if (isset($_POST["selection"])) {
if ($row["PERSON_ID"] == $_POST["selection"]) {
print"selected";
        }
      }
?>> <?phpprint$row["UserName"]; ?></option>
<?php
        }
?>
              </select>
      <input type="submit"name="Display"id="displayUsers"value="Display Users">
</form>
<?phpif (isset($_POST["selection"])) {
print"We will display the user ".$_POST["selection"] ."<br>";
$displayUsers = $connection->prepare("SELECT*FROM ppl WHERE PERSON_ID=?");
$displayUsers->bind_param("i", $_POST["selection"]);
$displayUsers->execute();
$result = $displayUsers->get_result();
if ($row = $result->fetch_assoc()) {
print$row["First_Name"] ."<br>";
print$row["Second_Name"] ."<br>";
print$row["Age"] ."<br>";
print$row["UserName"] ."<br>";
print$row["Nationality"] ."<br>";
print$row["User_type"] ."<br>";
    }
  } ?>
</body>
</html>