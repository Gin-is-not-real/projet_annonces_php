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
        <div>File name:
            <!-- <?= $data['content']; ?> -->
        </div>
    </div>

    <footer>
        <div>
            <a href="index.php?action=show&amp;id=<?= $data['id'] ?>">show</a>
        </div>
    </footer>
</section>