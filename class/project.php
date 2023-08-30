<?php
  class Project{
    private $conn;
    private $table_name = "project";

    public $id;
    public $name, $description;
    public $image;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    function read()
    {
        $query = "SELECT
                    id, name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    function readById()
    {
      // запрос MySQL
      $query = "SELECT name, description, image FROM " . $this->table_name . " WHERE id = ? limit 0,1";

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();

      if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $this->name = $row["name"];
        $this->description = $row["description"];
        $this->image = $row["image"];
        return true;
      }
      else{
        return false;
      }
    }

    function edit()
    {
       $query = "UPDATE " . $this->table_name . " SET name = '{$this->name}', description = '{$this->description}', image = '{$this->image}' WHERE id={$this->id}";

       $stmt = $this->conn->prepare($query);



       if ($stmt->execute()) {
           return true;
       } else {
           return false;
       }
    }

    // метод создания проекта
    function create()
    {
        // запрос MySQL для вставки записей в таблицу БД «project»
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, description=:description, image=:image";

        $stmt = $this->conn->prepare($query);

        // опубликованные значения
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image = htmlspecialchars(strip_tags($this->image));

        // привязываем значения
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function delete()
    {
      $query = "DELETE FROM
                " . $this->table_name . "
                WHERE id = ?";


      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id);
      if ($stmt->execute()){
        return true;
      }
      else{
        return false;
      }
    }
  }
?>
