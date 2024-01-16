<?php
    class databaseManager {
        private $_db;

        function __construct() {
            $this->_db = $this->setConnection();
        }

        function setConnection() {
            try {
                return new PDO('mysql:host=10.0.0.204;dbname=portfolio;charset=utf8', 'portfolio_usr', 'password');
            }
            catch {
                throw new Exception("Impossible de se connecter à la base de données.");
            }
        }

        function getConnection() {
            return $this->_db;
        }
    }
?>