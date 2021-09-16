<hr>
<div id="div-categories">
    <h3>categories</h3>
    
    <div class="content">
        <fieldset>
            <?php 
                while($field = $_POST['categories']->fetch()) {
                    $checked = '';
                    if($edit AND in_array(strtolower($field['name']), $categories)) {
                        $checked = 'checked';
                    }
                    // $checked = in_array(strtolower($field['name']), $categories) ? 'checked' : '';
            ?>
                    <div>
                        <label for="<?= $field['name']; ?>"><?= $field['name']; ?></label>
                        <input type="checkbox" name="categories[]" id="<?= $field['name']; ?>" value="<?= $field['name']; ?>" <?= $checked; ?> >
                    </div>
            <?php
                }
            ?>
        </fieldset>
    </div>
    <div>
        <label for="new-category">add a category</label>
        <input type="text" id="new-category" name="new-category" maxlength="15">
        <input type="button" id="btn-new-category" value="add category"></input>
    </div>
</div>
<hr>

