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

            <!-- FAVORITES -->
            <?php
                echo $_POST['offer']['favorite'];
                $text = $_POST['offer']['favorite'] ? 'remove' : 'add';
            ?>
                <a href="index.php?action=add-favorite&id=<?= $data['offerid']; ?>"><button value="<?= $data['offerid']; ?>"><?= $text; ?> to favorites</button></a>

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

<?php
    if(isset($_SESSION['username']) AND $_SESSION['username'] != $data['username']) {
    // if(isset($_GET['own']) AND $_GET['own'] != 'true') {
        include '_form-contact.php';
    }
?>

</main>
<?php 
    $content = ob_get_clean();
    require 'templates/base.php';