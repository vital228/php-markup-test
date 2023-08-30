<?php
  require "config/database.php";
  require "class/project.php";

  $database = new Database();
  $db = $database->getConnection();

  $project = new Project($db);

  var_dump($_GET);
  $ids = $_GET['deleteProject'];

  foreach ($ids as $id) {
    $project->id = $id;
    $project->readById();
    if ($project->image != "image/ImageNull.jpg"){
      unlink($project->image);
    }
    $project->delete();
  }

  header("Location: /");

 ?>
