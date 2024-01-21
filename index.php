<?php
    require('controllers/controller.php');

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
            default:
                error();
                break;
        }
    } else {
        homePage();
    }