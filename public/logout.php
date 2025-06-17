<?php

  require_once(__DIR__ . "/../view/header.php");

  if($userDao) {
    $userDao->destroyToken();
  }
