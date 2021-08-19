<?php 
    $title = 'Offers';
    ob_start();
?>

    <main>
        <div class="content">
            **offer/index.php</br>
            
            <?php 
                if(isset($_POST['all-offers']) AND !empty($_POST['all-offers'])) {

                    while($data = $_POST['all-offers']->fetch()) {
                        include '_offer.php';
                    }
                }
                $_POST['all-offers']->closeCursor();
            ?>
        </div>
    </main>
<?php 
    $content = ob_get_clean();
    require 'templates/base.php';