<?php

  require_once("globals.php");
  require_once("db.php");
  require_once("models/User.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");

  $message = new Message($BASE_URL);

  $userDao = new UserDAO($conn, $BASE_URL);

  // Resgata o tipo do formulário
  $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  // Atualizar usuário
  if($type === "update") {

    // Resgata dados do usuário
    $userData = $userDao->verifyToken();

    // Receber dados do post
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $bio = filter_input(INPUT_POST, "bio", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Criar um novo objeto de usuário
    $user = new User();

    // Preencher os dados do usuário
    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->bio = $bio;

    // Upload da imagem
    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
      
      $image = $_FILES["image"];
      $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
      $jpgArray = ["image/jpeg", "image/jpg"];

      // Checagem de tipo de imagem
      if(in_array($image["type"], $imageTypes)) {

        // Checar se jpg
        if(in_array($image["type"], $jpgArray)) {

          $imageFile = imagecreatefromjpeg($image["tmp_name"]);

        // Imagem é png
        } else {

          $imageFile = imagecreatefrompng($image["tmp_name"]);

        }

        $imageName = $user->imageGenerateName();

        imagejpeg($imageFile, "./img/users/" . $imageName, 100);

        $userData->image = $imageName;

      } else {

        $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");

      }

    }

    $userDao->update($userData);

  // Atualizar senha do usuário
  } else if($type === "changepassword") {

    // Receber dados do post
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Resgata dados do usuário
    $userData = $userDao->verifyToken();
    
    $id = $userData->id;

    if($password == $confirmpassword) {

      // Criar um novo objeto de usuário
      $user = new User();

      $finalPassword = $user->generatePassword($password);

      $user->password = $finalPassword;
      $user->id = $id;

      $userDao->changePassword($user);

    } else {
      $message->setMessage("As senhas não são iguais!", "error", "back");
    }

  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }