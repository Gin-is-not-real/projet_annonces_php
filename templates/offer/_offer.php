<section class="container">
    <header>
        <div class="offer-head">
            <h2 class="offer-title"><a href="index.php?action=show&amp;id=<?= $data['offerid']; ?>"><?= $data['title']; ?> </a></h2>
            <h2 class="offer-price"><?= $data['price']; ?></h2>
        </div>


        <h3 class="offer-user">Par: <?= $data['username']; ?></h3>
        <!-- <p class="offer-date">Publiée le: <?= $data['date']; ?></p> -->

        <?php
            $now = new DateTime();
            $interval = $now->diff(new DateTime($data['date']));
            $intervals = [
                'day' => $interval->format('%d'),
                'hour' => $interval->format('%h'),
                'minute' => $interval->format(('%i'))
            ];
            $str = 'Posted ';

            foreach($intervals as $key => $value) {
                if($value != 0) {
                    $str .= $value . ' ' . $key;
                    $str .= $value == 1 ? '' : 's ';
                }
            }
            $str .= ' ago';

        ?>

        <p class="offer-date"><?= $str; ?></p>
        <div><?= $data['place']; ?></div>
    </header>

    <div class="content">
        <div>Prix: 
            <?= $data['price']; ?> euros
        </div>
        <!-- <div>Lieu:
            <?= $data['place']; ?>
        </div> -->
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