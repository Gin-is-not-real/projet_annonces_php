<?php 
    if(!isset($_SESSION['username'])) {
        $logInfo = 'Not connected.';
        if(isset($_GET['action'])) {
            if($_GET['action'] != 'login-index' AND $_GET['action'] != 'logout') {
                $logInfo .=  ' Please <a href="index.php?action=login-index">Login or register</a>';
            }  
        }   
    }
    else {
        $logInfo = 'Connected as in ' . $_SESSION['username'] . '.      <a href="index.php?action=logout">Logout</a>';
    }

?>
<header id="general-header">
    <div id="log-info">
        <?= $logInfo; ?>
    </div>

    <nav>
        <ul>
            <li><a href="index.php?action=new">post an offer</a><li>
            <li><a href="index.php?action=offer-index">offers</a></li>
            <!-- <li><a href="index.php?action=admin">your offers</a></li> -->
        <?php
            if(isset($_SESSION['username'])) {
                echo '<li><a href="index.php?action=admin">your offers</a></li>';
                echo '<li><a href="index.php?action=favorites">your favorites</a></li>';
            }
        ?>
        </ul>
    </nav>
</header>
<hr>

    <?php 
        if(isset($_GET['notice'])){

            echo '<div id="notices">' . 'Your message about the offer ' . $_GET['id'] . ' has been sent' . '</div>';
        }
    ?>
    <?php include 'templates/_error.php'; ?>

</div>