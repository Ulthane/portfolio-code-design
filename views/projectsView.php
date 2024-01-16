<?php ob_start(); ?>

<section>
    Projects
</section>

<?php 
    $content = ob_get_clean();
     require('templates/base.php'); 
?>