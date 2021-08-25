<?php 
    $title = 'Admin';
    ob_start();
?>

    <main>
    **admin/index.php</br>

        <div class="container">
            <header>
                <h1>your offers</h1>
            </header>
            <div>
                <a href="index.php?action=new">new offer</a>
            </div>
            <?php 
                if(isset($_POST['user-offers']) AND !empty($_POST['user-offers'])) {
                    $data = $_POST['user-offers'];
                    
                    foreach($_POST['user-offers'] as $data) {
                        include 'templates/offer/_offer.php';

                        ?>
                        <footer class="offer-footer">
                            <div>
                                <a href="index.php?action=edit&amp;id=<?= $data['offerid']; ?>">EDIT</a>
                            </div>
                            <div>
                                <a href="index.php?action=delete&amp;id=<?= $data['offerid']; ?>">DELETE</a>
                            </div>
                        </footer>
            <?php
                    } 

                }
            ?>
        </div>

    </main>
<?php 
    $content = ob_get_clean();
    require 'templates/base.php';
