<?php 
    $title = 'Admin';
    ob_start();
?>
    <main>
    <!-- **login/index.php</br> -->

        <div class="container" id="login-main-container">
            <?php include 'templates/_error.php'; ?>
            <?php include('_form-login.php'); ?> 
            <?php include('_form-register.php'); ?> 

        </div>
    </main>
<?php 
    $content = ob_get_clean();
    require 'templates/base.php';