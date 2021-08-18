<?php 
if(isset($_POST['offer'])) {
    $values = [];
    $data = $_POST['offer']->fetchAll();
    
    // while($data = $_POST['offer']->fetch()) {
    //     var_dump($data);

    //     // foreach($data as $val) {
    //     //     var_dump($data, $val);
    //     //         $index = array_search($val, $data);
    //     //         $values[$index] = $val;
    //     // }
    // }
    var_dump($data[0]);

    $edit = true;
    $title = 'edit';
    $action = 'edit';
}

?>
<h2><?= $title; ?></h2>
<form action="index.php?action=<?= $action; ?>&amp;id=<?= $data[0]['id']; ?>;" method="post">
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
        <input type="submit">
    </div>
    
</form>