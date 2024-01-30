<?php
    // Fonction statique qui va envoyer un email avec les informations de la page contact
    class ContactManager
    {
        public static function sendMail()
        {
            $to      = 'ulthane.dev@orange.fr';
            $subject = $_POST["lastname"].' '.$_POST["firstname"].' vous a envoyé un message depuis PORTFOLIO !';
            $message = '
                <h1>Portfolio MSeb Dev.</h1>
                <ul>
                    <li>Nom : '.$_POST["lastname"].'</li>
                    <li>Prenom : '.$_POST["firstname"].'</li>
                    <li>Email : '.$_POST["email"].'</li>
                </ul>
                <h4>Message</h4>
                <p>'.$_POST["comentary"].'</p>
            ';

            try
            {
                mail($to, $subject, $message);
                header("location: index.php?page=contact&error=0&message=Succès d'envoie du mail !");
                exit();
            }
            catch(Exception $e)
            {
                header("location: index.php?page=contact&error=1&message=Echec d'envoie du mail - ".$e->getMessage());
                exit();
            }
        }
    }