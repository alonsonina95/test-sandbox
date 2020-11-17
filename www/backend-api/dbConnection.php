<?php
   class dbConnection {
        private $dbuser = "root";
        private $dbpass = "tiger";
        private $dsn = "mysql:host=mend-mysql;dbname=tasks;charset=utf8mb4";

        public function getConnection() {
            try {
                $connection = new PDO($this->dsn, $this->dbuser, $this->dbpass);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "CREATE TABLE IF NOT EXISTS tasks (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    task VARCHAR(30) NOT NULL
                    )";
                $connection->exec($sql);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
            return $connection;
        }
    }
?>