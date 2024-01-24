<?php
    isset($_GET['page']) ? $page = $_GET['page'] : $page = null;
    ob_start(); 
?>

<header>
    <div class="d-flex justify-content-between">
        
        <div class="d-flex">
            <div class="d-flex align-items-center name">
                <?php if (empty($_SESSION['username'])) { ?>
                    <a class="text-light-blue mx-3" href="index.php?page=login">connexion</a>
                <?php } else { ?>
                    <div class="d-flex align-items-center">
                        <a class="text-light-blue m-0 mx-3" href="index.php?page=admin"><?= strtolower(str_replace(' ', '-', $_SESSION['username'])) ?></a>
      
                        <form method="GET" action="index.php">
                            <input type="hidden" name="page" value="admin">
                            <button type="submit" name="logout" value="1">logout</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
            <nav>
                <ul class="navbar p-0">
                    <li class="<?php echo ($page === "home" || !isset($page) ? "active" : "");?>"><a class="text-light-blue" href="index.php?page=home">_bienvenue</a></li>
                    <li class="<?php echo ($page === "about-me" ? "active" : "");?>"><a class="text-light-blue" href="index.php?page=about-me&category=pro_category&id=1">_a-propos</a></li>
                    <li class="<?php echo ($page === "projects" ? "active" : "");?>"><a class="text-light-blue" href="index.php?page=projects">_projets</a></li>
                </ul>
            </nav>
        </div>
        
        <div class="contact">
            <a class="text-light-blue" href="index.php?page=contact">_contacter-moi</a>
        </div>
    </div>
</header>

<?php $header = ob_get_clean() ?>