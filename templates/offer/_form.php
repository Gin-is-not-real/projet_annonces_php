<?php 
// if(isset($_POST['offer'])) {
if(isset($offers)) {
    $values = [];
    // $data = $_POST['offer']->fetchAll();
    $data = $offers->fetchAll();
    $imgData = $images->fetchAll();
    // $images = $images->fetchAll();
    var_dump($imgData);

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
<div><a href="index.php?action=admin">your offers</a></div>

<h2><?= $title; ?></h2>
<form action="index.php?action=<?= $action ?>" method="POST" enctype="multipart/form-data">

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

    <hr>

    <?php 
        $src0 = isset($imgData[0]) ? $imgData[0]['filename'] : 'default';
        $act0 = isset($imgData[0]) ? 'update-img' : 'new-img';

        $src1 = isset($imgData[1]) ? $imgData[1]['filename'] : 'default';
        $act1 = isset($imgData[1]) ? 'update-img' : 'new-img';
    ?>
    <div>
        <figure>
            <img src="public/uploads/<?= $src0; ?>" alt="<?= $src0; ?>" width="100px" height="auto" >
        </figure>
        <input type="file" name="image-0" value="" >
        <input type="hidden" name="hidden-img0" value="<?= $act0; ?>">
    </div>

    <div>
        <figure>
            <img src="public/uploads/<?= $src1; ?>" alt="<?= $src1; ?>" width="100px" height="auto">
        </figure>
        <input type="file" name="image-1" value="" >
        <input type="hidden" name="hidden-img1" value="<?= $act1; ?>">
    </div>
        
    <div>
        <input type="submit">
    </div>
</form>


