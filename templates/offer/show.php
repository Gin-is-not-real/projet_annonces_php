<?php 
    $title = 'Offers';
    ob_start();

    $data = $_POST['offer'][0];

?>
<main>
    <div class="container">
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
                <div>Description:
                    <?= $data['content']; ?>
                </div>

                <div>Images:
                    <?php 
                        foreach($data['images'] as $image) {
                            echo '<div>image: ' . $image['filename'] . '</div>';
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