<?php 
if(isset($_POST['offer'])) {
    $values = [];
    $data = $_POST['offer']->fetchAll();
    $images = $_POST['images']->fetchAll();
    // die(var_dump($images[0]));

    $edit = true;
    $title = 'edit';
    $action = 'edit&amp;id=' . $data[0]['id'];
}
else {
    $edit = false;
    $title = 'new';
    $action = 'new';
}

?>
<h2><?= $title; ?></h2>
<form action="index.php?action=<?= $action ?>" method="post" enctype="multipart/form-data">

    <div>
        <label for="title">title</label>
        <input type="text" name="title" value="<?= $edit ? $data[0]['title'] : ''; ?>" required>
    </div>

    <div>
        <label for="price">price</label>
        <input type="number" name="price" value="<?= $edit ? $data[0]['price'] : ''; ?>" required>
    </div>

    <div>
        <label for="place">place</label>
        <input type="text" name="place" value="<?= $edit ? $data[0]['place'] : ''; ?>" required>
    </div>

    <div>
        <label for="content">description</label>
        <input type="text" name="content" value="<?= $edit ? $data[0]['content'] : ''; ?>" required>
    </div>

    <div>
        <label for="image">images</label></br>
        <div>
            <div> 
<!-- 
                <?php 
                    $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $_SERVER['SCRIPT_NAME'];
                    $path = str_replace('index.php', '', $path) . 'public/uploads/';
                    echo $path;
                ?> 
                -->
            </div>

        <div>    
            <input type="file" name="image" maxlength="255" >
        </div>

        <!-- <div>    
            <input type="file" name="image1" maxlength="255" >
        </div>
        <div>
            <input type="file" name="image2" maxlength="255">
        </div>
        <div>
            <input type="file" name="image3" maxlength="255">
        </div> -->


    </div>

    <div>
        <input type="submit">
    </div>
    
</form>
