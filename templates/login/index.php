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
        <?php 
            if(isset($_SESSION['username'])) {
                echo '<div>welcome ' . $_SESSION['username'] . '</div>';
                echo '<div><a href="index.php?action=logout">LOGOUT</a></div>';
            }
        ?>
    </header>

    <main>

        <div class="content">
            **login/index.php</br>
            
            <?php include 'templates/_error.php'; ?>

            
            <?php include('_form-login.php'); ?> 
            <?php include('_form-register.php'); ?> 

        </div>

    </main>

</body>
</html>