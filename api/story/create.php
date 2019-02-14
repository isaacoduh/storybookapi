<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once('../../config/Database.php');
  include_once('../../models/Story.php');

  $database = new Database();
  $db = $database->connect();

  // Instantiate story object
  $story = new Story($db);

  $data = json_decode(file_get_contents("php://input"));

  $story->title = $data->title;
  $story->body = $data->body;
  $story->author = $data->author;

  // Create story
  if($story->create()){
    echo json_encode(
      array('message' => 'Story Posted')
    );
  }else {
    echo json_encode( array('message' => 'Error posting your story'));
  }

 ?>
