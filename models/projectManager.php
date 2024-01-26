<?php
    class ProjectManager {
        private $_db;

        public function __construct()
        {
            $this->_db = DatabaseManager::getConnection(); 
        }

        public function getProject()
        {
            return $this->_db->query("SELECT * FROM projects");
        }

        public function postProject()
        {
            // Déclaration des variables
            $link = htmlspecialchars($_POST['link']);
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $tag = htmlspecialchars($_POST['tag']);
            $image = null;

            
            // Vérification de l'image
            if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
                if($_FILES['image']['size'] <= 3000000) {
                    $informationsImage = pathinfo($_FILES['image']['name']);
                    $extensionImage    = $informationsImage['extension'];
                    $extensionsArray   = ['png', 'gif', 'jpg', 'jpeg'];

                    if(in_array($extensionImage, $extensionsArray)){
                        $image = "./public/uploads/".time().rand().rand().'.'.$extensionImage;
                        move_uploaded_file($_FILES['image']['tmp_name'], $image);
                    }
                }
            }

            try 
            {
                $req = $this->_db->prepare("INSERT INTO projects (title, description, image, tag, link) VALUES (?, ?, ?, ?, ?)");
                $req->execute([$title, $description, $image, $tag, $link]);

                header("location: index.php?page=admin&category-adm=pro_category&error=0&message=Insertion effectuée avec succès");
            }
            catch (Exception $e)
            {
                header("location: index.php?page=admin&category-adm=pro_category&error=1&message=Insertion en base échoué - ".$e->getMessage());
                exit();
            }

        }

        public function deleteProject()
        {
            // On vérifie tout de meme que la session est bien en cours
            if (isset($_SESSION['username']))
            {
                $id = $_POST['choice']; // on récupère l'id du projet a delete

                // On va récuperer le nombre global de projet, s'il n'en reste qu'un, on ne pourra pas le supprimer
                $req = $this->_db->query('SELECT COUNT(*) AS total FROM projects');

                while ($res = $req->fetch())
                {
                    if ($res['total'] <= 1)
                    {
                        header("location: index.php?page=admin&category-adm=pro_category&error=1&message=Vous ne pouvez supprimer le dernier projet");
                        exit();
                    }
                }
                

                try {
                    $req = $this->_db->prepare("DELETE FROM projects WHERE id = ?");
                    $req->execute([$id]);
                }
                catch (Exception $e)
                {
                    header("location: index.php?page=admin&category-adm=pro_category&error=1&message=Erreur lors de la suppression - ".$e->getMessage());
                    exit();
                }
            }
        }
    }
?>