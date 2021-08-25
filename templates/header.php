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
            <li><a href="index.php?action=offer-index">offers</a></li>
            <li><a href="index.php?action=admin">your offers</a></li>

        <?php
            // if(isset($_SESSION['username'])) {
            //     // echo '<li><a href="index.php?action=admin">admin</a></li>';
            //     echo '<li id="li-logout"><a href="index.php?action=logout">logout</a></li>';
            // }
        ?>
        </ul>
    </nav>
</header>
<hr>