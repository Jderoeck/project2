<?php

include_once("classes/User.class.php");

if(!empty($_POST)){
    if(!empty($_POST["username"]) && !empty($_POST["password"])){
        $userLogin = new User();
        $userLogin->UserName = $_POST["username"];
        $userLogin->Password = $_POST["password"];

        //echo $userLogin->canLogin();

        if($userLogin->canLogin()){
            $_SESSION['loggedin'] = true;
            header('Location: camera.php');
        }
        else{
            echo "Foutieve Login gegevens";
        }
    }else{

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iedereen Beroemd</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
    <section class="login">
        <div class="upperbar">
            <h2 class="melduaan"> Log in </h2>
        </div>
        <div class="formWrapper">
        <form action="" method="post" class="form">
          <input type="text" name="username" class="inputtext" placeholder="Gebruikersnaam"><br>
          
          <input type="text" name="password" class="inputtext" placeholder="Paswoord"><br>
          
          
          <input type="submit" value="log in" class= "registreerknop">
        </form>
        </div>
    </section>
    
</body>
</html>