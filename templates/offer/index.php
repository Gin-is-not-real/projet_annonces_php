<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offers</title>
</head>

<body>
    <?php include 'templates/header.php'; ?>

    <main>
        <div class="content">
            **offer/index.php</br>
            
            <?php 
                if(isset($_POST['all-offers']) AND !empty($_POST['all-offers'])) {
                    $offers = $_POST['all-offers'];

                    while($data = $_POST['all-offers']->fetch()) {
                        include '_offer.php';
                    }
                }

            ?>

        </div>

    </main>

</body>
</html>