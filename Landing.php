<html>
<?php
error_reporting(0);
require_once __DIR__ . '/Facebook/autoload.php';
require 'config.php';

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email','user_posts','user_likes','pages_show_list']; // optional
$loginUrl = $helper->getLoginUrl('http://fb.local/Likes', $permissions);
?>
<head>
  <link rel="shortcut icon" href="like.png" type="image/png">
  <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
<video poster="" id="bgvid" playsinline autoplay muted loop>
  <source src="http://fb.local/fiber.mp4" type="video/mp4">
</video>
<div id="dna">
  <img src="facebook.png" style="width: 400px;"><img src="like.png" style="width: 150px;">
  <button><a href=<?php echo $loginUrl; ?>><img src="fb.svg"></a></button>
  <p style="font-family: Georgia;">MadDna</p>
</div>
</body>
</html>