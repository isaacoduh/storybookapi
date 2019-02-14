<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Story.php';

    $database = new Database();
    $db = $database->connect();

    $story = new Story($db);

    $data = json_decode(file_get_contents("php://input"));

    $story->id = $data->id;

    if($story->delete()){
      echo json_encode(array('message' => 'Story Deleted'));
    }else {
      echo json_encode(array('message' => 'Story was not deleted.'));
    }

  ?>
