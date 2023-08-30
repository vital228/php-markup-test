<?php
  require "class/funcImage.php";
  require "class/project.php";
  include_once "config/database.php";

  $database = new Database();
  $db = $database->getConnection();

  $project = new Project($db);

  if(isset($_POST['save_button'])){
    $can_upload = can_upload($_FILES["ufile"]);
    $errors = "";
    if ($_POST['name'] == "" || ($can_upload != true && $can_upload != false)){
      if ($_POST['name'] == ""){
        $errors .= "Название не может быть пустым. ";
      }
      $errors .= $can_upload;
    }
    else {
      $project->name = $_POST['name'];
      $project->description = $_POST['description'];

      if ($can_upload == true){
        $new_path = make_upload($_FILES["ufile"]);
        if ($_POST['path_image'] != "image/ImageNull.jpg")
          unlink($_POST['path_image']);
        $project->image = $new_path;
      }
      else if ($can_upload == false) {
        if (isset($_POST['deleteImage']) && $_POST['deleteImage'] == "on" && $_POST['path_image']!="image/ImageNull.jpg"){
          unlink($_POST['path_image']);
          $project->image = "image/ImageNull.jpg";
        }
        $project->image = $_POST['path_image'];
      }

      if (isset($_POST['id'])){
        $project->id = $_POST['id'];
        $project->edit();
      }
      else{
        $project->create();
      }
      //var_dump(Project::$array);
      header('Location: /');
      die();
    }
    if (isset($_POST['id'])) $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_POST['path_image'];
  }
  else{
    $project->id = $_POST['id'];
    if ($project->readById()){
      $id =  $_POST['id'];
      $name = $project->name;
      $description = $project->description;
      $image = $project->image;
    }
    else{
      $errors = "Такого проекта нет";
    }
  }



  require "view/editForm.php"
?>
