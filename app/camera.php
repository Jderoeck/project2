
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
    <div id="timer"></div>
  <div id="vidContainer">

    <video id="gum" autoplay muted></video>
    <video id="recorded" autoplay loop></video>

    <div id="btns">
      <button class="btn" id="record">Opnemen</button>
      <button class="btn" id="play" disabled>afspelen</button>
      <form action="uploadvid.php" method="post" class="uploadFile">
          <input type="hidden" name="filevid" id="filevid">
          <input type="url" name="urlvid" id="urlvid">
          <input type="submit" class="btn" id="upload" value="verzenden">
  </form>
      <button class="btn" id="download" disabled>verzenden</button>
    </div>

  </div>
  

  <!-- include adapter for srcObject shim -->
  <script src="../../../js/adapter.js"></script>
  <script src="js/main.js"></script>
  <script src="../../../js/lib/ga.js"></script>
</section>
</body>
</html>
