<?php
    class DatabaseManager {

        public static function getConnection() {
            try {
                return new PDO('mysql:host=172.16.10.6;dbname=portfolio;charset=utf8', 'portfolio_usr', 'password');
            }
            catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
        
    }
?>