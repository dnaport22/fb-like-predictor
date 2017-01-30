<?php
require_once __DIR__ . '/Facebook/autoload.php';
session_start();

$fb = new Facebook\Facebook([
  'app_id' => '1019494864821387',
  'app_secret' => '4f37cf1b82db804ae094bbbaf4dc928d',
  'default_graph_version' => 'v2.5',
]);