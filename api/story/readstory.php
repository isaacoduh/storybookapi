<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Story.php';

  $database = new Database();
  $db = $database->connect();

  $story = new Story($db);

  $story->id = isset($_GET['id']) ? $_GET['id'] : die();

  $story->readstory();

  $story_arr = array(
    'id' => $story->id,
    'title' => $story->title,
    'body' => $story->body,
    'author' => $story->author
  );

  // JSON Response
  print_r(json_encode($story_arr));
 ?>
