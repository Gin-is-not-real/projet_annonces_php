<?php 
    $title = 'Offers';
    ob_start();

    $data = $_POST['offer']->fetch();

?>
<main>
    <div class="content">
        **offer/show.php</br>

        <section>
            <header>
                <h2><?= $data['title']; ?> </h3>
                <h3>Par: <?= $data['username']; ?></h3>
                <p>Publiée le:
                <?= $data['date']; ?>
                </p>
            </header>

            <div class="offer-content">
                <div>Prix: 
                    <?= $data['price']; ?> euros
                </div>
                <div>Lieu:
                    <?= $data['place']; ?>
                </div>
                <div>
                    <?= $data['content']; ?>
                </div>
            </div>

            <footer>

            </footer>
        </section>
            
    </div>
</main>
<?php 
    $content = ob_get_clean();
    require 'templates/base.php';