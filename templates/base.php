<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
    
    <header>
        <?php 
            if(isset($_SESSION['username'])) {
                echo '<div>welcome ' . $_SESSION['username'] . '</div>';
                echo '<div><a href="index.php?action=logout">LOGOUT</a></div>';
            }
        ?>
    </header>

    <main>
        *base.php
        <?php include 'offer/index.php'; ?>
    </main>

</body>
</html>