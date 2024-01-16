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
            default:
                homePage();
                break;
        }
    } else {
        homepage();
    }