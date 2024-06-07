<?php
    namespace Rjpinks\UfcScraper\ConnectionClasses;

    use Rjpinks\UfcScraper\ConnectionClasses\Config;

    /**
     * SQLite connnection
     */
    class SQLiteConnection
    {
        /**
         * PDO instance
         * @var \PDO 
         */
        private $pdo;

        /**
         * return in instance of the PDO object that connects to the SQLite database
         * @return \PDO
         */
        public function connect()
        {
            try {
                $this->pdo = new \PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
             } catch (\PDOException $e) {
                echo "Error Code: " . $e->getMessage() . PHP_EOL;
             }
            return $this->pdo;
        }
    }
?>