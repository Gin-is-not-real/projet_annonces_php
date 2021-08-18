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
</section>