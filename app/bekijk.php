<?php
include_once("classes/Db.class.php");
session_start();

    $conn = Db::getInstance();
        $id=$_GET["id"];
        $stmt = $conn->prepare("SELECT * FROM antwoord WHERE ID = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($results);
        
        $like = $results[0]["like"];
        $dislike = $results[0]["dislike"];
    if(!empty($_POST)){
        if(isset($_POST['like'])){
            $like = $like + 1;
        }
        else{
            $dislike = $dislike +1;
        }
        $stmt2 = $conn->prepare("UPDATE antwoord SET like = :like, dislike = :dislike WHERE ID = :id");
        $stmt2->bindParam(":like", $like);
        $stmt2->bindParam(":dislike", $dislike);
        $stmt2->execute();
        header("location:feed.php");
    }
?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="description" content="WebRTC code samples">
  <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1">
  <meta itemprop="description" content="Client-side WebRTC code samples">
  <meta itemprop="image" content="../../../images/webrtc-icon-192x192.png">
  <meta itemprop="name" content="WebRTC code samples">
  <meta name="mobile-web-app-capable" content="yes">
  <meta id="theme-color" name="theme-color" content="#ffffff">


<uses-feature android:name="android.hardware.camera" />
<uses-feature android:name="android.hardware.camera.autofocus" />
<uses-feature android:glEsVersion="0x00020000" android:required="true" />

<uses-permission android:name="android.permission.CAMERA" />
<uses-permission android:name="android.permission.RECORD_AUDIO" />
<uses-permission android:name="android.permission.INTERNET" />
<uses-permission android:name="android.permission.ACCESS_NETWORK_STATE" />
<uses-permission android:name="android.permission.MODIFY_AUDIO_SETTINGS" />

  <base target="_blank">

  <title>MediaStream Recording</title>

  
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">

</head>

<body>
   <section class="cam">
  <div id="vidContainer">

    <video id="recorded" class="theVid" src="<?php echo $results[0]["vidUrl"] ?>" autoplay loop></video>

    <div id="btns">
      <button class="btn" id="play">afspelen</button>
    </div>
    <input type="hidden" id="readme" value="<?php echo $results[0]["video"] ?>">
  </div>
  <form action="" method="post" style="display:flex; margin-top: 20px;">
      <input class="btn" type="submit" name="dislike" value="dislike">
      <input class="btn" type="submit" name="like" value="like">
  </form>

  <!-- include adapter for srcObject shim -->
  <script src="../../../js/adapter.js"></script>
  <script src="js/main3.js"></script>
  <script src="../../../js/lib/ga.js"></script>
</section>
</body>
</html>
