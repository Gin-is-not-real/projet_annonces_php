<?php 
    $title = 'Admin';
    ob_start();
?>

    <main>

        <div class="content">
            **admin/index.php</br>
            <?php 
                if(isset($_POST['user-offers']) AND !empty($_POST['user-offers'])) {
                    $offers = $_POST['user-offers'];
                    while($data = $_POST['user-offers']->fetch()) {
                        // var_dump($data);
                        include 'templates/offer/_offer.php';
                        // include '../../offer/_offer.php';
            ?>
                        <footer class="offer-footer">
                            <div>
                                <a href="index.php?action=edit&amp;id=<?= $data['id']; ?>">EDIT</a>
                            </div>
                        </footer>
            <?php
                    }
                    $_POST['user-offers']->closeCursor();
                }
            ?>
        </div>

    </main>
<?php 
    $content = ob_get_clean();
    require 'templates/base.php';
