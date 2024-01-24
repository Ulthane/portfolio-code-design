<?php
    session_start(); // On autorise l'enregistrement sous forme de session
    require('controllers/controller.php');

    // ROUTEUR selon le GET page
    if (isset($_GET['page'])) {
        switch ($_GET['page'])
        {
            case 'projects':
                projectsPage();
                break;
            case 'about-me':
                aboutMePage();
                break;
            case 'error':
                error();
                break;
            case 'home':
                homePage();
                break;
            case 'login':
                login();
                break;
            case 'contact':
                contact();
                break;
            case 'admin':
                admin();
                break;
            default:
                error();
                break;
        }
    } else {
        homePage();
    }