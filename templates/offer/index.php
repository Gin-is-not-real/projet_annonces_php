<div class="content">
    **offer/index.php</br>
    
    <?php 

    if(isset($_POST['all-offers']) AND !empty($_POST['all-offers'])) {
        $offers = $_POST['all-offers'];

        while($data = $_POST['all-offers']->fetch()) {
            var_dump($data);
        }
    }


    ?>

</div>
