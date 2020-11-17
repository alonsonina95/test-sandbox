<?php

    class DeleteTask {

        private $taskToBeDeleted;
        private $connection;
        
        public function __construct($db, $task) {
            $this->taskToBeDeleted = $task ;
            $this->connection = $db;
        }

        public function deleteTask() {
            try {
                $sql = "DELETE FROM tasks WHERE task='$this->taskToBeDeleted';";
                $rowsUpdated = $this->connection->exec($sql);
                return "success";

            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }   
        }
    }
?>