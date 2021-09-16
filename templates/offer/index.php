<?php 
    $title = 'Offers';
    $currentDirectory = basename(__DIR__); 
    $h = isset($_POST['h']) ? $_POST['h'] : 'All offers'; 
    ob_start();
?>

    <main>
        <div class="container main-container">
            <header>
                <!-- <h1><?= $h; ?></h1> -->
                <h1><?= $h; ?></h1>
            </header>

            <div class="content offers-list">
                <?php 
                    if(isset($_POST['all-offers']) AND !empty($_POST['all-offers'])) {
                        $data = $_POST['all-offers'];
                        
                        foreach($_POST['all-offers'] as $data) {
                            include '_offer.php';
                        } 
                    }
                ?>
            </div>
        </div>
    </main>
<?php 
    $content = ob_get_clean();
    require 'templates/base.php';