<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="public/style/sass/style.scss" rel="stylesheet"> -->
    <link href="public/style/sass/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <title><?= $title ?></title>
</head>

<?php include 'templates/header.php'; ?> 


<body>
    <?= $content ?>

    <script type="text/javascript" src="public/scripts/addCategory.js"></script>
</body>

</html>