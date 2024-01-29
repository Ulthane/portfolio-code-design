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

        public function getProjectById()
        {
            $req = $this->_db->prepare("SELECT * FROM projects WHERE id = ?");
            $req->execute([$_POST['selection']]);

            while($res = $req->fetch())
            {
                return $res;
            }
        }

        public function getCategory()
        {
            $query = "SELECT * FROM ".htmlspecialchars($_POST['selection']);
            return $this->_db->query($query);
        }

        public function getArticle($select)
        {
            $table = "pi_content";

            if ($select === "pro_category")
            {
                $table = "pro_content";
            } else if ($select === "hob_category")
            {
                $table = "hob_content";
            }

            $query = "SELECT * FROM $table";
            return $this->_db->query($query);
        }

        public function getArticleById()
        {
            $table = "pi_content";

            if ($_GET['selection'] === "pro_category")
            {
                $table = "pro_content";
            } else if ($_GET['selection'] === "hob_category")
            {
                $table = "hob_content";
            }

            $query = "SELECT * FROM $table WHERE id = ".$_POST['id-modify'];
            $req = $this->_db->query($query);

            while($res = $req->fetch())
            {
                return $res;
            }
        }

        public function putProject()
        {
            // Déclaration des variables
            $link = htmlspecialchars($_POST['link']);
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $tag = htmlspecialchars($_POST['tag']);
            $id = htmlspecialchars($_GET['modify']);

            try 
            {
                $req = $this->_db->prepare("UPDATE projects SET title = ?, description = ?, tag = ?, link = ? WHERE id = ?");
                $req->execute([$title, $description, $tag, $link, $id]);

                header("location: index.php?page=admin&category-adm=pro_category&type=modify&error=0&message=Mise à jour effectuée avec succès");
            }
            catch (Exception $e)
            {
                header("location: index.php?page=admin&category-adm=pro_category&type=modify&error=1&message=Mise à jour en base échoué - ".$e->getMessage());
                exit();
            }
        }

        public function putArticle()
        {
            // Déclaration des variables
            $table = "pi_content";

            if ($_GET['selection'] === "pro_category")
            {
                $table = "pro_content";
            } else if ($_GET['selection'] === "hob_category")
            {
                $table = "hob_content";
            }

            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['description']);
            $id = htmlspecialchars($_GET['modify']);
        
            try 
            {
                $req = $this->_db->prepare("UPDATE $table SET title = ?, content = ? WHERE id = ?");
                $req->execute([$title, $content, $id]);
        
                header("location: index.php?page=admin&category-adm=pi_category&type=modify&error=0&message=Mise à jour effectuée avec succès");
            }
            catch (Exception $e)
            {
                header("location: index.php?page=admin&category-adm=pi_category&type=modify&error=1&message=Mise à jour en base échoué - ".$e->getMessage());
                exit();
            }
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

                header("location: index.php?page=admin&category-adm=pro_category&type=add&error=0&message=Insertion effectuée avec succès");
            }
            catch (Exception $e)
            {
                header("location: index.php?page=admin&category-adm=pro_category&type=add&error=1&message=Insertion en base échoué - ".$e->getMessage());
                exit();
            }

        }

        public function postArticle()
        {
            $table = "pi_content";

            if ($_GET['selection'] === "pro_category")
            {
                $table = "pro_content";
            } else if ($_GET['selection'] === "hob_category")
            {
                $table = "hob_content";
            }

            $query = "INSERT INTO ".$table." (category_id, title, content) VALUES (".$_POST['selection-category'].",'".$_POST['title']."','".$_POST['content']."')";

            try
            {
                $this->_db->query($query);
                header("location: index.php?page=admin&category-adm=pi_category&type=add&error=0&message=Article ajouté avec succès !");
            }
            catch (Exception $e)
            {
                header("location: index.php?page=admin&category-adm=pi_category&type=add&error=1&message=Erreur lors de l'ajout - ".$e->getMessage());
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
                        header("location: index.php?page=admin&category-adm=pro_category&type=delete&error=1&message=Vous ne pouvez supprimer le dernier projet");
                        exit();
                    }
                }
                

                try {
                    $req = $this->_db->prepare("DELETE FROM projects WHERE id = ?");
                    $req->execute([$id]);

                    header("location: index.php?page=admin&category-adm=pro_category&type=delete&error=0&message=Suppression effectuée avec succès !");
                }
                catch (Exception $e)
                {
                    header("location: index.php?page=admin&category-adm=pro_category&type=delete&error=1&message=Erreur lors de la suppression - ".$e->getMessage());
                    exit();
                }
            }
        }

        public function deleteArticle()
        {
            $id = htmlspecialchars($_POST['id-delete']); // on récupère l'id du projet a delete

            $table = "pi_content";

            if ($_GET['selection'] === "pro_category")
            {
                $table = "pro_content";
            } else if ($_GET['selection'] === "hob_category")
            {
                $table = "hob_content";
            }

            // On va récuperer le nombre global de projet, s'il n'en reste qu'un, on ne pourra pas le supprimer
            $query = "SELECT COUNT(*) AS total FROM $table";
            $req = $this->_db->query($query);

            while ($res = $req->fetch())
            {
                if ($res['total'] <= 1)
                {
                    echo "delete";
                    header("location: index.php?page=admin&category-adm=pi_category&type=delete&error=1&message=Vous ne pouvez supprimer le dernier article");
                    exit();
                }
            }

            try {
                $query = "DELETE FROM $table WHERE id = $id";
                $this->_db->query($query);

                header("location: index.php?page=admin&category-adm=pi_category&type=delete&error=0&message=Suppression effectuée avec succès !");
            }
            catch (Exception $e)
            {
                header("location: index.php?page=admin&category-adm=pi_category&type=delete&error=1&message=Erreur lors de la suppression - ".$e->getMessage());
                exit();
            }
        }
    }
?>