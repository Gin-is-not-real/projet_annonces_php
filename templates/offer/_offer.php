<section class="offer-container">
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

        <div class="img-container">Images:
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
        <div>
            <a href="index.php?action=show&amp;id=<?= $data['offerid']; ?>">show</a>
        </div>
    </footer>
</section>