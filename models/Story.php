<?php
  /**
   *
   */
  class Story
  {
    //DB Variables
    private $conn;
    private $table = 'stories';

    // Story Property
    public $id;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public function __construct($db)
    {
      // code...
      $this->conn = $db;
    }

    //Get Stories
    public function readall(){
      $query = 'SELECT id, title, body, author FROM ' . $this->table . ' ORDER BY id DESC';
      //prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Get Story
    public function readstory(){
      $query = 'SELECT id, title, body, author FROM '. $this->table . ' WHERE id = ? LIMIT 0,1';
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->title = $row['title'];
      $this->body = $row['body'];
      $this->author = $row['author'];
    }
    // Create Story
    public function create(){
      $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body=:body, author = :author';

      // prepare
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->body = htmlspecialchars(strip_tags($this->body));
      $this->author = htmlspecialchars(strip_tags($this->author));

      //bind parameters
      $stmt->bindParam(':title', $this->title);
      $stmt->bindParam(':body', $this->body);
      $stmt->bindParam(':author', $this->author);
      // Execute query
      if($stmt->execute()){
        return true;
      }
      printf("Error: %s.\n", $stmt->error);
      return false;
    }
    // Update Story
    public function update(){
      $query = 'UPDATE ' . $this->table . ' SET title = :title, body = :body, author = :author WHERE id = :id';
      $stmt = $this->conn->prepare($query);

      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->body = htmlspecialchars(strip_tags($this->body));
      $this->author = htmlspecialchars(strip_tags($this->author));
      $this->id = htmlspecialchars(strip_tags($this->id));

      $stmt->bindParam(':title', $this->title);
      $stmt->bindParam(':body', $this->body);
      $stmt->bindParam(':author', $this->author);
      $stmt->bindParam(':id', $this->id);


      if($stmt->execute()){
        return true;
      }

      printf("Error: %s.\n", $stmt->error);
      return false;
    }
    // Delete Story
    public function delete(){
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
      $stmt = $this->conn->prepare($query);
      $this->id = htmlspecialchars(strip_tags($this->id));
      $stmt->bindParam(':id',$this->id);

      if($stmt->execute()){
        return true;
      }

      printf("Error: %s. \n", $stmt->error);
      return false;
    }

  }


 ?>
