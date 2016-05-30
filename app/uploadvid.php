<?php
include_once("classes/Db.class.php");
session_start();

if(!empty($_POST)){
        
    //print_r($_POST);
     $video = $_POST["filevid"];
     $vidUrl = $_POST["urlvid"];
     $userID = $_SESSION["ID"];
    
    $PDO = Db::getInstance();
    $stmt = $PDO->prepare("INSERT INTO antwoord (video, vidUrl, user_ID) VALUES (:video, :vidUrl, :userID);");
 		$stmt->bindValue(':video', $video);
 		$stmt->bindValue(':vidUrl', $vidUrl);
 		$stmt->bindValue(':userID', $userID);
 		
        
 		if ($stmt->execute())
        {
            
            header("location: feed.php");
            //query went OK!
            return(true);
           
 		}
    
}

?>