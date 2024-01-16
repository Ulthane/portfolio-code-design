<?php ob_start(); ?>
<footer class="h-5">
    <div class="d-flex">
        <div class="item left"><p class="m-0">retrouvez-moi sur:</p></div>
        <div class="item left"><a class="text-light-blue" href="#"><i class="fa-brands fa-linkedin-in icon"></i></a></div>
    </div>

    <div>
        <div class="item right"><a class="text-light-blue" href="#">@username <i class="icon fa-brands fa-github"></i></a></div>
    </div>
</footer>
<?php $footer = ob_get_clean(); ?>