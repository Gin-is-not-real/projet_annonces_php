<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>

<body>
    <?php include 'templates/header.php'; ?>

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
                }

            ?>

        </div>

    </main>

</body>
</html>