<?php
  include_once "class/project.php";
  include_once "config/database.php";

  $database = new Database();
  $db = $database->getConnection();

  $project = new Project($db);

  $name = "";
  $description = "";
  $image = "image/ImageNull.jpg";
  $errors = "";
  if (isset($_GET['id'])){
    $project->id = $_GET['id'];
    $project->readById();
    $id =  $_GET['id'];
    $name = $project->name;
    $description = $project->description;
    $image = $project->image;
  }
  require_once "view/editForm.php";
 ?>
