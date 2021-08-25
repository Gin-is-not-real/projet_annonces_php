<?php 
    $title = 'Offers';
    ob_start();

    $data = $_POST['offer'][0];

?>
<main>
**offer/show.php</br>

    <div class="container">

        <section>
            <header>
                <h2 class="offer-title"><?= $data['title']; ?> </h2>
                <h3 class="offer-user">Par: <?= $data['username']; ?></h3>
                <p class="offer-date">Publiée le: <?= $data['date']; ?></p>
            </header>

            <div class="content">
                <div>Prix: 
                    <?= $data['price']; ?> euros
                </div>
                <div>Lieu:
                    <?= $data['place']; ?>
                </div>
                <div>Description:
                    <?= $data['content']; ?>
                </div>

                <div class="container img-container">
                <?php 
                foreach($data['images'] as $image) {
            ?>
                <figure>
                    <img src="public/uploads/<?= $image['filename']; ?>" alt="<?= $image['filename']; ?>" width="100px" height="auto">
                    <figcaption><?= $image['filename']; ?></figcaption>
                </figure>


            <?php
                }
            ?>

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