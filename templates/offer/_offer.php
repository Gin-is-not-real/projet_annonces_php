<section>
    <div class="container offer-container">
    <header>
        <div class="offer-header">
            <h2 class="offer-title"><a href="index.php?action=show&amp;id=<?= $data['offerid']; ?>"><?= $data['title']; ?> </a></h2>
            <h2 class="offer-price"><?= $data['price']; ?> €</h2>
        </div>

        <!-- <h3 class="offer-user">Par: <?= $data['username']; ?></h3> -->
        <!-- formatage de la str pour la date -->
        <?php
            $now = new DateTime();
            $interval = $now->diff(new DateTime($data['date']));
            $intervals = [
                'day' => $interval->format('%d'),
                'hour' => $interval->format('%h'),
                'minute' => $interval->format(('%i'))
            ];
            $dateStr = 'Posted ';

            foreach($intervals as $key => $value) {
                if($value != 0) {
                    $dateStr .= $value . ' ' . $key;
                    $dateStr .= $value == 1 ? '' : 's ';
                }
            }
            $dateStr .= ' ago';
        ?>

        <div class="offer-sub-header">
            <div class="offer-date"><?= $dateStr; ?></div>
            <div class="offer-place"><p><i class="fab fa-periscope"></i></p> <p><?= $data['place']; ?></p></div>
        </div>
    </header>

    <div class="content">
        <div class="img-container">
            <div class="img-preview">
                <?php
                    $file = isset($data['images'][0]) ? "public/uploads/" .$data['images'][0]['filename'] : 'public/images/default-image-300x225.jpg';
                ?>
                    <figure>
                        <img src="<?= $file; ?>" alt="<?= $file; ?>" >
                    </figure>
                </div>

            <!-- <div class="img-mini"> -->
                <?php 
                    foreach($data['images'] as $image) {
                ?>
                <!--  
                    <figure>
                        <img src="public/uploads/<?= $image['filename']; ?>" alt="<?= $image['filename']; ?>" width="50px" height="auto">
                        <figcaption><?= $image['filename']; ?></figcaption>
                    </figure>
                -->
                <?php
                    }
                ?>
            <!-- </div> -->
        </div>

        <?php 
            $description = strlen($data['content']) > 100 ? substr($data['content'], 0, 100) . ' ...' : $data['content'];
        ?> 

        <div class="offer-description">
            <?= $description; ?>
        </div>
    </div>

    </div>
    
    <?php 
    include 'templates/' . $currentDirectory . '/_offer-footer.php';
    if($currentDirectory == 'admin') {
        include '_offer-footer.php';
    }
?>
</section>
