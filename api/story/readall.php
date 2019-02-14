<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application-json');

  include_once '../../config/Database.php';
  include_once '../../models/Story.php';

  $database = new Database();
  $db = $database->connect();

  $story = new Story($db);

  $result = $story->readall();

  // get row count
  $num = $result->rowCount();

  // Confirm for Stories

  if($num > 0){
    // Stories array
    $story_arr = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $story = array(
        'id' => $id,
        'title' => $title,
        'body' => html_entity_decode($body),
        'author' => $author
      );

      // push to "data"
      array_push($story_arr, $story);

    }
    // convert to json and output result
    echo json_encode($story_arr);
  }else{
    echo json_encode(array('message' => 'No stories available'));
  }

 ?>
