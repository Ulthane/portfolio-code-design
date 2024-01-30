<?php
    require('models/database.php');
    require('models/loginManager.php');
    require('models/infoManager.php');
    require('models/projectManager.php');

    
    // Controlleur de la page d'accueil
    function homePage() 
    {
        require('views/homeView.php');
        require('templates/base.php');
    }

    // Controleur de la page à propos de moi
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
    
        $infoManger = new InfoManager();
        $category = $infoManger->getPICategory(htmlspecialchars($_GET['category']));
        $title = $infoManger->getPITitle(htmlspecialchars($_GET['category']));
        $content = null;

        // if (isset($_GET['id']) && $_GET['id'] != "min")
        // {
            $content = $infoManger->getPIContent(htmlspecialchars($_GET['category']), htmlspecialchars($_GET['id']));
        // }
        // else {
        //     $content = $infoManger->getPIContent(htmlspecialchars($_GET['category']), $infoManger->getFirstId($_GET['category']));
        // }

        require('views/aboutMeView.php');
        require('templates/base.php'); 
    }

    // Controleur de la page des projets
    function projectsPage() 
    {
        $projectManager = new ProjectManager();
        $projects = $projectManager->getProject();

        require('views/projectsView.php');
    }

    // Controlleur pour les pages d'erreur
    function error()
    {
        require('views/error.php');
        require('templates/base.php');
    }

    // Controlleur pour la page de login
    function login()
    {
        // Si la session existe, on redirige vers la page d'admin
        if (isset($_SESSION['username']) && !empty($_SESSION['username']))
        {
            header("location: index.php?page=admin&category-adm=pro_category&type=add");
        }
        
        // Sinon on va vérifier que l'on a setter le nom d'utilisateur et le mot de passe avant de contacter la DB
        if (isset($_POST['username']) || isset($_POST['password']))
        {
            LoginManager::getLogin(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']));
        }
        
        require('views/loginView.php');
        require('templates/base.php');
    }

    // Controlleur pour la page d'administatrion
    function admin()
    {
        $categoryAdm = "_informations";

        if ($_GET['category-adm'] === "pro_category")
        {
            $categoryAdm = "_projets";
        }
        
        require('templates/navigation-admin.php');
        require('templates/navigation-type.php');
        
        if ($_GET['category-adm'] === "pro_category")
        {
            require('views/adminProjectView.php');
        } else {
            require('views/adminInfoView.php');
        }
        
        require('templates/base.php');
    }

    // Controlleur pour la page contact
    function contact()
    {
        require('views/contactView.php');
        require('templates/base.php');
    }