<?php 
    $page = $_GET['page'];
    ob_start(); 
?>
<header class="h-5">
    <div class="d-flex m-0">
        <p class="name">sebastien-m.</p>
        <nav>
            <ul class="navbar p-0">
                <li class="<?php echo ($page === "home" || !isset($page) ? "active" : "");?>"><a class="text-light-blue" href="index.php?page=home">_bienvenue</a></li>
                <li class="<?php echo ($page === "about-me" ? "active" : "");?>"><a class="text-light-blue" href="index.php?page=about-me">_a-propos</a></li>
                <li class="<?php echo ($page === "projects" ? "active" : "");?>"><a class="text-light-blue" href="index.php?page=projects">_projets</a></li>
            </ul>
        </nav>
    </div>

    <div class="contact">
        <a class="text-light-blue" href="#">_contactez-moi</a>
    </div>
</header>
<?php $header = ob_get_clean() ?>