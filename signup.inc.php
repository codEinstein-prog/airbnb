<? php

  if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $userName = $_POST["Uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];
  }

require_once 'database.inc.php';
require_once 'functions.inc.php';

else{
  header("location: ../signup.php");
}
