<?php 
    $title = 'Offers';
    ob_start();
    $data = $_POST['offer'][0];
?>
<main class="main-show-offer">
    <section class="container offer-show-container">
        <header>
            <div class="offer-header">
                <h2 class="offer-title"><a href="index.php?action=show&amp;id=<?= $data['offerid']; ?>"><?= $data['title']; ?> </a></h2>
                <h2 class="offer-price"><?= $data['price']; ?> €</h2>
            </div>

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

            <div class="container img-container">

                <div class="img-preview">
                <?php
                    $file = isset($data['images'][0]) ? "public/uploads/" .$data['images'][0]['filename'] : 'public/images/default-image-300x225.jpg';
                ?>
                    <figure>
                        <img src="<?= $file; ?>" alt="<?= $file; ?>" >
                    </figure>
                </div>

                <div class="img-mini">
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

            <div class="offer-description">
                <?= $data['content']; ?>
            </div>
        </div>
            <footer>

            </footer>
        </section>

        <section class="container seller-container">
                <header>
                    <h1>Send a message</h1>
                </header>
            <header>
                <h3 class="offer-user">To: <?= $data['username']; ?></h3>
            </header>

            <div class="form-container">

                <form action="index.php?action=mail" method="post" class="form-contact">
                <div class="content">
                    <div>
                        <label for="mail-from">Mail: </label>
                        <input type="email" name="mail-from" required>
                    </div>
                    <div>
                        <label for="mail-message">Message: </label>
                        <textarea name="mail-message" required></textarea>
                    </div>
                    <input type="hidden" name="mail-to" value="<?= $data['usersid']; ?>">
                    <input type="hidden" name="mail-about" value="<?= $data['offerid']; ?>">

                    <input type="submit">
                </div>
                </form>
            </div>

        </section>
            
</main>
<?php 
    $content = ob_get_clean();
    require 'templates/base.php';