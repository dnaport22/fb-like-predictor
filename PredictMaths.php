<?php

/**
 * Class PredictMaths
 */
class PredictMaths {

  public function averageLikes($data) {
    $avg = array_sum($data)/count($data);
    $maximum = max($data);
    $diff = round($maximum - $avg);
    $random = rand(0, $diff);

    // @return average of likes in the list.
    //return round($avg);

    // @return mixed stuff.
    return round($avg + $random);
  }
}

//$test = array(24,54,67,23,7,10);
$y = new PredictMaths();
//echo $y->averageLikes($test);
//echo "You are expected to get over " . $y->averageLikes($x->numOfLikes()) . " Likes on your next facebook post.";