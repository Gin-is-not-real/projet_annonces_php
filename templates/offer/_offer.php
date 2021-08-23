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
        <div>
            <a href="index.php?action=show&amp;id=<?= $data['offerid']; ?>">show</a>
        </div>
    </footer>
</section>