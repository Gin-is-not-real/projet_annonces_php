<div class="error-log">
    <?php 
        if(isset($_POST['login-error'])) {
            echo $_POST['login-error'] . '</br>';
        }
        if(isset($_POST['add-cat-error'])) {
            echo $_POST['add-cat-error'] . '</br>';
        }
    ?>
</div>