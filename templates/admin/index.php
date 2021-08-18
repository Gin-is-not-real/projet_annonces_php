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
            

        </div>

    </main>

</body>
</html>