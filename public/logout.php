<?php

  require_once(__DIR__ . "/../mvc/view/header.php");

  if($userDao) {
    $userDao->destroyToken();
  }
