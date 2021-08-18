<?php 
?>
<header>

<?php 
    if(isset($_SESSION['username'])) {
        echo '<div>welcome ' . $_SESSION['username'] . '</div>';
        echo '<div><a href="index.php?action=logout">LOGOUT</a></div>';
        echo '<div><a href="index.php?action=offer-index">OFFERS</a></div>';
        echo '<div><a href="index.php?action=admin">ADMIN</a></div>';
    }
    else {
        echo '<div><a href="index.php?action=login-index">LOGIN OR REGISTER</a></div>';
    }
?>
</header>