<?php

    class CreateTask {

        private $newTask;
        private $connection;
        
        public function __construct($db, $task) {
            $this->newTask = $task ;
            $this->connection = $db;
        }

        public function insertTaskToDb() {
            try {
                $sql = "INSERT INTO tasks (task) VALUES ('$this->newTask')";
                $rowsUpdated = $this->connection->exec($sql); 
                return $this->newTask;

            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }   
        }
    }
?>