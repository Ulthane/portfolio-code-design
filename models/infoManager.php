<?php
    class InfoManager {
        private $_db;

        private function _categoryType($category)
        {
            return explode("_", $category)[0];
        }

        public function __construct()
        {
            $this->_db = DatabaseManager::getConnection(); 
        }

        public function getPICategory($category) 
        {
            // On trie les catégorie
            $query = "SELECT * FROM $category";
            return $this->_db->query($query);
        }

        public function getPITitle($category)
        {
            // Création d'un tableau qui recevra les categories
            $resultArray = [];

            // Création des requetes
            $queryCat = 'SELECT name FROM '.$this->_categoryType($category).'_category';
            $query = 'SELECT pcon.id AS id, name, title FROM '.$this->_categoryType($category).'_category AS pcat INNER JOIN '.$this->_categoryType($category).'_content AS pcon WHERE pcon.category_id = pcat.id';

            // On va recuperer les catégories
            $req = $this->_db->query($queryCat);
            while($res = $req->fetch())
            {
                $resultArray[$res['name']] = [];
            }

            // On traite les titre retourné
            $req = $this->_db->query($query);

            while ($res = $req->fetch(PDO::FETCH_ASSOC)) {
                array_push($resultArray[$res['name']], [
                    "id" => $res['id'],
                    "title" => $res['title']
                ]);
            }

            return $resultArray;
        }

        public function getPIContent($category, $id)
        {

            $query = 'SELECT content, title FROM '.$this->_categoryType($category).'_content WHERE id = '.$id;
            $req = $this->_db->query($query);

            while ($res = $req->fetch())
            {
                return $res;
            }
        }
    }
?>