<?php
  require_once "blocks/header.php";
?>
  <div class="container">
    <h1>Проект</h1>
    <form action="/edit" method="post" enctype="multipart/form-data">
      <?php if (isset($id)): ?><input type="hidden" name="id" value="<?=$id?>" /> <?php endif ?>
      <input type="hidden" name="path_image" value="<?=$image?>">
      <img src="<?=$image?>" class="img-thumbnail" alt="..." width="300" height="300">
      <input type="text" name="name" placeholder="Название проекта" class="form-control" value="<?=$name?>">
      <textarea name="description" placeholder="Описание" class="form-control"><?=$description ?></textarea>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="deleteImage">
        <label class="form-check-label" for="same-address">Удалить фотографию</label>
      </div>
      <input type="file" name="ufile">
      <div>
        <a href="/" class="btn btn-primary">Вернуться</a>
        <input type="submit" value="Сохранить" class="btn btn-success" name="save_button">
      </div>
      <div>
        <?php if ($errors != ""): ?>
          <p>*<?=$errors?></p>
        <?php endif ?>
      </div>
    </form>
  </div>
<?php require_once "blocks/footer.php"; ?>
