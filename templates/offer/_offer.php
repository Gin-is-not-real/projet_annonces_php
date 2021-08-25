<section class="container">
    <header>
        <a href="index.php?action=show&amp;id=<?= $data['offerid']; ?>"><h2 class="offer-title"><?= $data['title']; ?> </h2></a>

        <!-- <h2 class="offer-title"><?= $data['title']; ?> </h2> -->
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
        <!-- <div>
            <a href="index.php?action=show&amp;id=<?= $data['offerid']; ?>">show</a>
        </div> -->
    </footer>
</section>