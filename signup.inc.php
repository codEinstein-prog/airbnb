<? php

  if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $userName = $_POST["Uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];
  

    require_once 'database.inc.php';
    require_once 'functions.inc.php';
  
    if(emptyInputSignup($name, $email, $userName, $pwd, $pwdRepeat) !== false){
       header("location: ../signup.php?error=emptyinput");
       exit();
    }
  
    if(InvalidUid($userName) !== false){
       header("location: ../signup.php?error=InvalidUid");
      exit();
    }
    
    if(Invalidemail($email) !== false){
       header("location: ../signup.php?error=Invalidemail");
      exit();
    }
    
    if(pwdMatch($pwd, $pwdRepeat) !== false){
       header("location: ../signup.php?error=passwordsdontmatch");
      exit();
    }
    
    if(UidExist($conn, $userName) !== false){
       header("location: ../signup.php?error=usernamestaken");
      exit();
    }
    
    createUser($conn, $name, $email, $username, pwd);
}

else{
  header("location: ../signup.php");
}
