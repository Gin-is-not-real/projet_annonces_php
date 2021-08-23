<?php 
    $title = 'Offers';
    ob_start();
?>

    <main>
        <div class="content">
            **offer/index.php</br>
            
            <?php 
                if(isset($_POST['all-offers']) AND !empty($_POST['all-offers'])) {
                    $data = $_POST['all-offers'];
                    
                    foreach($_POST['all-offers'] as $data) {
                        include '_offer.php';
                    } 
                }
            ?>
        </div>
    </main>
<?php 
    $content = ob_get_clean();
    require 'templates/base.php';