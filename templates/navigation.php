<?php ob_start(); ?>

<section class="d-flex flex-column align-items-center navigation">
    <div class="my-3"><a class="navigation__active" href=#><i class="icon fa-solid fa-laptop-code"></i></a></div>
    <div class="my-3"><a class="text-light-blue" href=#><i class="icon fa-solid fa-lightbulb"></i></a></div>
    <div class="my-3"><a class="text-light-blue" href=#><i class="icon fa-solid fa-gamepad"></i></a></div>
</section>

<?php $navigation = ob_get_clean(); ?>