<?php 
    $title = 'Admin';
    ob_start();
?>

    <main>
    **admin/index.php</br>

        <div class="content">
            <header>
                <h1>your offers</h1>
            </header>
            <div>
                <a href="index.php?action=new">new offer</a>
            </div>
            <?php 
                if(isset($_POST['user-offers']) AND !empty($_POST['user-offers'])) {
                    var_dump($_POST['user-offers']);
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
                            <div>
                                <a href="index.php?action=delete&amp;id=<?= $data['id']; ?>">DELETE</a>
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
