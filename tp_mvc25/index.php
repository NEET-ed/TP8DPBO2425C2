<?php


$table = isset($_GET['table']) ? $_GET['table'] : null;
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

$controller = null;

if($table == 'lecturers') {
  include "controllers/LecturerController.php";
  $controller = new LecturerController();
} else if($table == 'courses') {
  include "controllers/CourseController.php";
  $controller = new CourseController();
} 

if($action == 'index') {
  $controller->index();
} elseif($action == 'create') {
  $controller->create();
} elseif($action == 'update') {
  $controller->update($id);
} elseif($action == 'delete') {
  $controller->delete($id);
} else {
  $controller->index();
}

?>