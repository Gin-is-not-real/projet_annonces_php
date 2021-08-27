<?php 
$title = 'Form';
ob_start();

// if(isset($_POST['offer'])) {
if(isset($offers)) {
    $values = [];
    // $data = $_POST['offer']->fetchAll();
    $data = $offers->fetchAll();
    $imgData = $images->fetchAll();
    // $images = $images->fetchAll();
    // var_dump($imgData);
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

<div class="container offer-form-container">
    <header>
        <h2><?= $title; ?></h2>
    </header>

    <form action="index.php?action=<?= $action ?>" method="POST" enctype="multipart/form-data">

        <div class="form-inputs">
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
                <!-- <input type="text" name="content" value="<?= $edit ? $data[0]['content'] : ''; ?>" required> -->
                <textarea name="content" value="<?= $edit ? $data[0]['content'] : ''; ?>" required></textarea>
            </div>
        </div>

    <?php 
        $src0 = isset($imgData[0]) ? $imgData[0]['filename'] : 'default';
        $act0 = isset($imgData[0]) ? 'edit-img' : 'new-img';

        $src1 = isset($imgData[1]) ? $imgData[1]['filename'] : 'default';
        $act1 = isset($imgData[1]) ? 'edit-img' : 'new-img';

        $src2 = isset($imgData[2]) ? $imgData[2]['filename'] : 'default';
        $act2 = isset($imgData[2]) ? 'edit-img' : 'new-img';
    ?>

    <div class="form-img">
        <!-- img 0 -->
        <div>
            <figure>
                <img src="public/uploads/<?= $src0; ?>" alt="<?= $src0; ?>" width="100px" height="auto" >
                
            </figure>
            <input type="file" name="image-0" value="" >
            <input type="hidden" name="hidden-img0" value="<?= $act0; ?>">
    <?php 
            if(isset($imgData[0])) {
    ?>            
    <?php
            }
    ?>
        </div>

        <div class="img-delete">
            <input type="hidden" name="hidden-id0" value="<?= $imgData[0]['id']; ?>">
            <a href="index.php?action=delete-img&amp;id=<?= $imgData[0]['id']; ?>&amp;filename=<?= $imgData[0]['filename']; ?>">delete</a>
        </div>


        <!-- img 1 -->
        <div>
            <figure>
                <img src="public/uploads/<?= $src1; ?>" alt="<?= $src1; ?>" width="100px" height="auto">
            </figure>
            <input type="file" name="image-1" value="" >
            <input type="hidden" name="hidden-img1" value="<?= $act1; ?>">

            <?php 
            if(isset($imgData[1])) {
    ?>            
    <?php
            }
    ?>
        </div>
        <div class="img-delete">
            <input type="hidden" name="hidden-id1" value="<?= $imgData[1]['id']; ?>">
            <a href="index.php?action=delete-img&amp;id=<?= $imgData[1]['id']; ?>&amp;filename=<?= $imgData[1]['filename']; ?>">delete</a>
        </div>

        <!-- img 2 -->
        <div>
            <figure>
                <img src="public/uploads/<?= $src2; ?>" alt="<?= $src2; ?>" width="100px" height="auto">
            </figure>
            <input type="file" name="image-2" value="" >
            <input type="hidden" name="hidden-img2" value="<?= $act2; ?>">
            <?php 
            if(isset($imgData[2])) {
    ?>            
    <?php
            }
    ?>
        </div>

        <div class="img-delete">
            <input type="hidden" name="hidden-id2" value="<?= $imgData[2]['id']; ?>">
            <a href="index.php?action=delete-img&amp;id=<?= $imgData[2]['id']; ?>&amp;filename=<?= $imgData[2]['filename']; ?>">delete</a>
        </div>
    </div>

    
    <div>
        <input type="submit">
    </div>
</form>
</div>

<?php 
    $content = ob_get_clean();
    require 'templates/base.php';
 


