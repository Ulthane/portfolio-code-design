<?php
    class LoginManager {

        public static function getLogin()
        {   
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            $salt = '$5$rounds=5000$believemybestformation$';
            $encrypt = crypt($password, $salt);

            $db = DatabaseManager::getConnection();
            $req = $db->prepare("SELECT COUNT(*) AS total FROM users WHERE username = ? and password = ?");
            $req->execute([$username, $encrypt]);

            while ($res = $req->fetch())
            {
                if ($res['total'] !== 0)
                {
                    $_SESSION['username'] = "Mucha Sebastien";
                    header("location: index.php?page=admin");
                } else {
                    header("location: index.php?page=login&error=1&message=Nom d'utilisateur ou mot de passe invalide");
                    exit();
                };
            }
        }

        public static function getLogout()
        {
            if( isset($_GET['logout']) && $_GET['logout'] == 1 ) {
                session_unset();
                session_destroy();

                header("location: index.php?page=home");
            }
        }
    }

?>