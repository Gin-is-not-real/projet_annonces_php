<?php 

echo 'test' . '</br>';

if(isset($_GET['action'])) {
    echo 'action: ' . $_GET['action'] . '</br>';
}
if(isset($_POST['message'])) {
    echo 'message: ' . $_POST['message'] . '</br>';
}

?>