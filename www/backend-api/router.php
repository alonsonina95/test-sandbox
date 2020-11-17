<?php

    include_once 'GetTask.php';
    include_once 'CreateTask.php';
    include_once 'dbConnection.php';
    include_once 'UpdateTask.php';
    include_once 'DeleteTask.php';
    require_once('errorFunctions.php');

    $database = new dbConnection();
    $db = $database->getConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $task = $data['task'];
        if ($task === "") {
            echo emptyTask();
        } else {
            $createTask = new CreateTask($db, $task);
            $result = $createTask->insertTaskToDb();
            echo json_encode(
                array('message' => $result)
            );
        }
        
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $getTask = new GetTasks($db);
        $result = $getTask->getAllTasks();
        $num = $result->rowCount();
        if($num > 0) {
            $task_array = array();
            $task_array['data'] = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $task_item = array(
                    'id' => $id,
                    'task' => $task
                );

                array_push($task_array['data'], $task_item);
            }

            echo json_encode($task_array);
        } else {
            echo json_encode(
                array('message' => 'NO DATA FOUND')
            );
        }

    } else if ( $_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $data = json_decode(file_get_contents('php://input'), true);
        $deleteTask = new DeleteTask($db, $data['task']);
        $result = $deleteTask->deleteTask();
        echo json_encode(
            array('message' => $result)
        );
     
    } else if ( $_SERVER['REQUEST_METHOD'] === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        $updateTask = new UpdateTask($db, $data['oldTask'], $data['newTask']);
        $result = $updateTask->updateTask();
        echo json_encode(
            array('message' => $result)
        );
        
    } else {
        echo json_encode(
            array('message' => 'Wrong request')
        );
    }
?>