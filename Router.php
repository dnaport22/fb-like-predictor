<?php
class Router {

  private $server;
  private $path;

  public function __construct() {
    $this->setServer($_SERVER['SERVER_NAME']);
    $this->setPath($_SERVER['REQUEST_URI']);
  }

  public function route() {
    switch ($this->getPath()) {
      case "/":
        include 'Landing.php';
        break;
      case "Likes":
        include 'Likes.php';
        break;
    }
  }

  private function setPath($path) {
    $this->path = $path;
  }

  private function getPath() {
    return $this->path;
  }

  private function setServer($location) {
    $this->server = $location;
  }

  private function getServer() {
    return $this->server;
  }
}

$r = new Router();
$r->route();