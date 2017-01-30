<?php
include 'PredictUserLikes.php';
include 'PredictMaths.php';

?>
<html>
<head>
  <link rel="stylesheet" href="styles.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script>
    function chooseImage() {
      document.getElementById('img_file').click();
    }

    function predictLikes() {
      document.getElementById('score').style.display = 'inline';
    }

    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.style.display = 'inline';
      output.src = URL.createObjectURL(event.target.files[0]);
      document.getElementById('choose').style.display = 'none';
      document.getElementById('analyse').style.display = 'inline';
    };
    
    function logout() {

      $.ajax({
        type: 'POST',
        url: 'http://fb.local/logout.php',
        success: function (res) {
          console.log('logging out');
          window.location = 'http://fb.local';
        },
        error: function (err) {
          console.log(err)
        }
      })
    }
  </script>

</head>
<body>
<video poster="" id="bgvid" playsinline autoplay muted loop>
  <source src="http://fb.local/fiber.mp4" type="video/mp4">
</video>

<div class="top-bar">
  <h2>Facebook Like Predictor</h2>
  <button onclick="logout()" class="button" style="position: absolute; right: 0; margin: 5px;">Logout</button>
</div>

<div class="loading-bar"></div>
<div class="page-wrapper">
  <div class="score-card">
    <div class="result">
      <div class="text">
        <h2>Logged in as <?php echo $username ?></h2>
        <h3 id="score" style="display: none;">You are expected to get <?php echo $y->averageLikes($userLikes->numOfLikes()); ?>
        likes on this post.</h3>
      </div>
    </div>
    <img class="img" id="output" style="display: none;"/>
    <input type="file" accept="image/*" id="img_file" onchange="loadFile(event)" hidden>
    <button class="button" onclick="chooseImage()" id="choose">Choose image</button>
    <button class="button" onclick="predictLikes()" id="analyse" style="display: none;">Predict Likes</button>
  </div>
</div>
</body>
</html>