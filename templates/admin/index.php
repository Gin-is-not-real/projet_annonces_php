<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>
<body>
    <header>

    </header>

    <main>
        <?php 
            if(isset($_SESSION['username'])) {
                echo '<div>welcome ' . $_SESSION['username'] . '</div>';
                echo '<div><a href="index.php?action=logout">LOGOUT</a></div>';
                echo '<div><a href="index.php?action=offer-index">OFFERS</a></div>';
            }
        ?>

<div class="content">
            **admin/index.php</br>
            
            <?php 
                if(isset($_POST['user-offers']) AND !empty($_POST['user-offers'])) {
                    $offers = $_POST['user-offers'];

                    while($data = $_POST['user-offers']->fetch()) {
                    ?>
                        <section>
                            <header>
                                <h2><?= $data['title']; ?> </h3>
                                <p>Publiée le:
                                    <?= $data['date']; ?>
                                </p>
                            </header>

                            <div class="offer-content">
                                <div>Prix: 
                                    <?= $data['price']; ?> euros
                                </div>
                                <div>Lieu:
                                    <?= $data['place']; ?>
                                </div>
                                <div>
                                    <?= $data['content']; ?>
                                </div>
                            </div>
                        </section>

<?php
                    }
                }

            ?>

        </div>

    </main>

</body>
</html>