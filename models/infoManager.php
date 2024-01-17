<?php
    require('models/database.php');

    class InfoManager {
        private $_db;

        public function __construct()
        {
            $this->_db = DatabaseManager::getConnection(); 
        }

        public function getPICategory() 
        {
            return $this->_db->query('SELECT * FROM pi_category');
        }

        public function getPITitle()
        {
            $resultArray = [
                "bio" => [],
                "interets" => [],
                "scolarité" => []
            ];

            $req = $this->_db->query('  
                SELECT pcon.id AS id, name, title 
                FROM pi_category AS pcat INNER JOIN pi_content AS pcon
                WHERE pcon.category_id = pcat.id
            ');

            while ($res = $req->fetch(PDO::FETCH_ASSOC)) {
                array_push($resultArray[$res['name']], [
                    "id" => $res['id'],
                    "title" => $res['title']
                ]);
            }

            return $resultArray;
        }

        public function getPIContent($id)
        {
            $req = $this->_db->prepare('SELECT content, title FROM pi_content WHERE id = ?');
            $req->execute([$id]);

            while ($res = $req->fetch())
            {
                return $res;
            }
        }
    }
?>