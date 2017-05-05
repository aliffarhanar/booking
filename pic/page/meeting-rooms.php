<?php
  if(isset($_GET['ruangan'])){
      include_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'meeting-rooms/ruangan.php');
  } else {
    include_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'meeting-rooms/meeting-rooms.php');
  }
?>