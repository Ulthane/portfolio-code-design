<?php
    
    function homePage() 
    {
        require('views/homeView.php');
        require('templates/base.php');
    }

    function aboutMePage() 
    {
        $categoryList = ['pro_category', 'pi_category', 'hob_category'];

        // Traitement de la category de la page
        if (!isset($_GET['category'])) {
            header("location: index.php?page=error&error=500");
            exit();
        } else if (!in_array($_GET['category'], $categoryList)) {
            header("location: index.php?page=error&error=404");
            exit();
        }

        // Traitement de la page
        require('templates/navigation.php');
        require('models/infoManager.php');
    
        $infoManger = new InfoManager();
        $category = $infoManger->getPICategory(htmlspecialchars($_GET['category']));
        $title = $infoManger->getPITitle(htmlspecialchars($_GET['category']));
        $content = $infoManger->getPIContent(htmlspecialchars($_GET['category']), htmlspecialchars($_GET['id']));

        require('views/aboutMeView.php');
        require('templates/base.php'); 
    }

    function projectsPage() 
    {
        require('views/projectsView.php');
    }

    function error()
    {
        require('views/error.php');
        require('templates/base.php');
    }