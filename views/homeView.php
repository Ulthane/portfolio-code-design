<?php ob_start(); ?>

<div class="d-flex h-100 align-items-center row overflow-hidden">
    <section class="anim-to-top col d-flex flex-column justify-content-center" id="prez-col">
        <div class="my-4 section-left">
            <p class="text-light my-2">Bonjour à tous, je m'appelle</p>
            <h1 class="text-light my-2">Sebastien M.</h1>
            <h3 class="text-info m-0">> Developpeur full-stack</h3>
        </div>
        
        <div class="my-4 section-left">
            <p>
                <!-- <span class="text-light-blue text-start">// terminez le jeu pour continuer</span><br> -->
                <span class="text-light-blue">// vous pouvez également me retrouvez sur github<br>
                <span class="text-info">const<span> <span class="text-success">githubLink</span> = <span class="text-primary">"https://github.com/example/url"</span>
            </p>
        </div>
        <div class="blur-section">
            <img class="blur-section__green" src="public/assets/images/green.png" alt="effet de flou vert">
            <img class="blur-section__blue" src="public/assets/images/blue.png" alt="effet de flou bleu">
        </div>
    </section>


    <section class="mx-5 col" id="code-col">

        <div class="w-75 anim-to-bottom">
            <?php 
            $o = .33;
            for ($i=0; $i<5; $i++) { 
                echo "<img width='550' style='opacity: ".$o."' class='my-2' src='public/assets/images/code-snippet.png' alt='extrait de code'>";
                
                if ($i < 2) {
                    $o += .33;
                } else {
                    $o -= .33;
                }
            } 
            ?> 
        </div>
    </section>
</div>

<?php 
    $content = ob_get_clean();
?>