<?php
  require_once "blocks/header.php";
  require "class/project.php";
  include "config/database.php";
?>
<div id="delete-projects">
  <form action="delete" method="get">
  <div>
    <a href="edit" class="btn btn-success">Создать</a>
    <button type="button" class="btn btn-danger" @click="openModal">Удалить</button>
      <!-- Модальное окно -->
      <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Заголовок модального окна</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
              Вы уверены, что хотите удалить эти проекты?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
              <button type="submit" class="btn btn-primary">Да</button>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div>
    <ul class="list-group">
      <?php
        $database = new Database();
        $db = $database->getConnection();

        $project = new Project($db);

        $stmt = $project->read();
        while ($row_project = $stmt->fetch(PDO::FETCH_ASSOC)) {
          extract($row_project);
          echo '<li class="list-group-item">';
          echo '<a href="/edit?id='.$id.'">'.$name.'</a>';
          echo '<input type="checkbox" name="deleteProject[]" value='.$id.' v-model="checkedNames">';
          echo '</li>';
        }
        ?>
    </ul>
  </div>
</form>
</div>
<script type="text/javascript">
  new Vue({
    el: '#delete-projects',
    data: {
      checkedNames: []
    },
    methods: {
      openModal: function(event){
        if (this.checkedNames.length > 0){
          const myModal = new bootstrap.Modal('#deleteModal',{})
          myModal.show()
        }
      }
    }
  })
</script>
<?php require_once "blocks/footer.php"; ?>
