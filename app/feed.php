<?php
include_once("classes/Db.class.php");
session_start();

$conn = Db::getInstance();

        $stmt = $conn->prepare("SELECT * FROM antwoord");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($results);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iedereen Beroemd</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
    <section class="feed">
        <div class="upperbar__feed">
            <img src="images/logo%20klein.png" class="logo" alt="iedereen beroemd logo">
        </div>
        <div id="list">
            <?php
                foreach($results as $result){
                    $id = $result['user_ID'];
                    //echo $result['vidUrl'];
                    $stmt2 = $conn->prepare("SELECT * FROM account WHERE ID = :id");
                    $stmt2->bindParam(":id", $id);
                    $stmt2->execute();
                    $res = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    echo '<div class="theVid">
                    <input type="hidden" id="theblob" value="'.$result['video'].'">
                    <video id="recorded" class="theRealVid" autoplay loop src="'.$result['vidUrl'].'"></video>
                    <br>
                    <p class="username">'.$res[0]['gebruikersnaam'].'</p>
                    <a href="bekijk.php?id='.$result['ID'].'" class="accountknop2">bekijk</a>
                    </div>';
                }
            ?>
        </div>
        <div class="buttons">
       <div class="populair"><h4 class="h4populair">Populair</h4></div>
       <div class="nieuw"><h4 class="h4nieuw">Nieuw</h4></div>
        </div>
        
        <!-- include adapter for srcObject shim -->
  <script src="../../../js/adapter.js"></script>
  <script src="js/main2.js"></script>
  <script src="../../../js/lib/ga.js"></script>
    </section>
</body>
</html>