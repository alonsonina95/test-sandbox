<?php

    class UpdateTask {

        private $oldTask;
        private $newTask;
        private $connection;
        
        public function __construct($db, $oldTask, $newTask) {
            $this->oldTask = $oldTask ;
            $this->newTask = $newTask;
            $this->connection = $db;
        }

        public function updateTask() {
            try {
                $sql = " UPDATE tasks set task='$this->newTask' where task='$this->oldTask';";
                $this->connection->exec($sql);
                return "success";
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }   
        }
    }
?>