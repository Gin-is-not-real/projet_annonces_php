<?php 
    $title = 'Offers';
    $currentDirectory = basename(__DIR__); 
    ob_start();
?>

    <main>
        <!-- **offer/index.php</br> -->

        <div class="container">
            <header>
                <h1>all offers</h1>
            </header>
            
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