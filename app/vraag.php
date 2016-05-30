<?php
    /*include_once("classes/Db.class.php");


    $vandaag = date('Y-m-d');
    

    $PDO = Db::getInstance();
    $stmt = $PDO->prepare("SELECT * FROM vraag WHERE datum = :vandaag");
    $stmt->bindParam(':vandaag', $vandaag);
    $stmt = $stmt->execute();
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo $result["vraagVandaag"];
    }*/
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iedereen Beroemd</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section class="vraag">
       <div class="titelVraag">
            <?php 
            /*echo $vandaag;
           print_r($stmt);*/
           ?>
           <h1>Vraag van vandaag:</h1>
       </div>
        <div class="zeshoek">
            <h3>Wat vind je van de inspiratiebeurs?</h3>
        </div>
        <div class="vraagLinks">
            <a href="registratie.php" class="antwoord">Antwoord</a>
            <a href="feed.php" class="ontdek">Ontdek</a>
        </div>
    </section>
 
</body>
</html>