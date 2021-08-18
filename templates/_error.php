<div class="error-log">
        <?php 
            if(isset($_POST['login-error'])) {
                echo $_POST['login-error'] . '</br>';
            }
        ?>
    </div>