<?php
include_once("classes/User.class.php");
if(!empty($_POST))
    	{
            $user = new User();
            $user->UserName = $_POST['username'];
            $user->Password = $_POST['password'];
            $user->Email = $_POST['email'];
            $user->Name = $_POST['name'];
            $user->LastName = $_POST['lastname'];
            $user->Gender = $_POST['gender'];
            $user->City = $_POST['city'];
            //print_r($_POST);

        try{
        			if($user->UsernameAvailable()) {
            				if($user->Create()){ //INSERT USER INTO TABLE
                             if($user->canLogin()){
            $_SESSION['loggedin'] = true;
            header('Location: camera.php');
        }
        else{
            echo "Foutieve Login gegevens";
        } 
                        }
            				$feedback = "Thanks for signing up!";
            			} else {
            				$feedback = "Username has already been taken!";
            			}
 		}
 		catch (Exception $e)
 		{
        			$feedback = $e->getMessage();
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
            <h2 class="melduaan"> Meld u aan </h2>
        </div>
        <form action="" method="post" class="form">
          <input type="text" name="username" class="inputtext" placeholder="Gebruikersnaam"><br>
          <input type="text" name="name" class="inputtext" placeholder="Voornaam"><br>
          <input type="text" name="lastname" class="inputtext" placeholder="Achternaam"><br>
          <input type="text" name="email" class="inputtext" placeholder="Email adress"><br>
          <input type="text" name="password" class="inputtext" placeholder="Paswoord"><br>
          <input type="text" name="gender" class="inputtext" placeholder="Geslacht"><br>
          <input type="text" name="city" class="inputtext" placeholder="Gemeente"><br>
          
          <input type="submit" value="Creëer Account" class= "registreerknop">
        </form>
        <p class="of">OF</p>
        <div class="facebook"></div>
        <a href="login.php" class="accountknop">Ik heb al een account</a>
    </section>
    
</body>
</html>