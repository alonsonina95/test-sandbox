<?php

    class GetTasks {
        
        private $id;
        private $connection;
        private $table = 'tasks';

        public function __construct($db) {
            $this->connection = $db;

        }

        public function getAllTasks() {
            $query = 'SELECT 
                    task
                    FROM
                    ' . $this->table;

            $statement = $this->connection->prepare($query);
            $statement->execute();
            return $statement;
        }


        public function getTask($task) {
            $query = 'SELECT 
                        task
                            FROM
                                ' . $this->table . '
                                    WHERE task = ' .$task;
            $statement = $this->connection->prepare($query);
            $statement->execute();
            return $statement;
                    
        }
        
    }

?>