<?php
error_reporting(0);
require_once __DIR__ . '/Facebook/autoload.php';
require 'config.php';

/**
 * Class PredictUserLikes
 */
class PredictUserLikes {

  /**
   * @var mixed
   */
  protected $userToken;

  /**
   * @var mixed
   */
  private $app;
  private $feed_data;
  private $username;

  /**
   * @var array
   */
  private $post_id = array();
  private $post_likes = array();

  /**
   * Retrieve user feeds from facebook account.
   */
  public function userFeeds() {
    $req = $this->getApp()->get('/me/feed', $this->getToken());
    $this->setFeedData($req->getDecodedBody());
  }

  /**
   * @return mixed
   */
  public function userName() {
    $res = $this->getApp()->get('/me?fields=id,name', $this->getToken());
    $user = $res->getGraphUser();
    $this->setUsername($user['name']);

    return $this->getUsername();
  }

  /**
   * Retrieve id of each feed.
   */
  public function feedId() {
    foreach ($this->getFeedData() as $post) {
      foreach ($post as $feed) {
        $this->setPostId($feed['id']);
      }
    }
  }

  /**
   * @return array
   */
  public function numOfLikes() {
    foreach ($this->getPostId(0, 10) as $pid) {
      $req = $this->getApp()->get('/' . $pid . '/likes?limit=5000', $this->getToken());
      $body = $req->getDecodedBody();
      $like_counter = count($body['data']);
      $this->setPostLikes($like_counter);
    }

    return $this->getPostLikes();
  }

  public function logOut() {
    session_destroy();
  }

  public function renderData() {
    var_dump($this->getPostLikes());
  }

  /**
   * @param $fb_app
   */
  public function load($fb_app) {
    $this->setApp($fb_app);
    $helper = $fb_app->getRedirectLoginHelper();
    $this->setToken($helper->getAccessToken());

  }

  /**
   * @param $name
   */
  private function setUsername($name) {
    $this->username = $name;
  }

  /**
   * @param $token
   */
  private function setToken($token) {
    $this->userToken = $token;
  }

  /**
   * @param $likes
   */
  private function setPostLikes($likes) {
    $this->post_likes[] = $likes;
  }

  /**
   * @param $id
   */
  private function setPostId($id) {
    $this->post_id[] = $id;
  }

  /**
   * @param $data
   */
  private function setFeedData($data) {
    $this->feed_data = $data;
  }

  /**
   * @param $app
   */
  private function setApp($app) {
    $this->app = $app;
  }

  /**
   * @return mixed
   */
  private function getUsername() {
    return $this->username;
  }

  /**
   * @return array
   */
  private function getPostLikes() {
    return $this->post_likes;
  }

  /**
   * @param $from
   * @param $till
   * @return array
   */
  private function getPostId($from, $till) {
    $ids = array_slice($this->post_id, $from, $till);
    return $ids;
  }

  /**
   * @return mixed
   */
  private function getFeedData() {
    return $this->feed_data;
  }

  /**
   * @return mixed
   */
  private function getApp() {
    return $this->app;
  }

  /**
   * @return mixed
   */
  private function getToken() {
    return $this->userToken;
  }
}
$userLikes = new PredictUserLikes();
$userLikes->load($fb);
var_dump($userLikes->userFeeds());
$userLikes->feedId();
//$username = $userLikes->userName();