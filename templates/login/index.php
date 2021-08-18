<?php 
    $title = 'Admin';
    ob_start();
?>
    <main>
        <div class="content">
            **login/index.php</br>
            
            <?php include 'templates/_error.php'; ?>
            
            <?php include('_form-login.php'); ?> 
            <?php include('_form-register.php'); ?> 

        </div>
    </main>
<?php 
    $content = ob_get_clean();
    require 'templates/base.php';