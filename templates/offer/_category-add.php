<div>
                <label for="categories">categories</label>
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
                <!-- <input type="checkbox" name="categories"> -->
            </div>

<div>
<label for="new-category">add a category</label>
    <input type="text" id="new-category" name="new-category" maxlength="15">
    <input type="button" id="btn-new-category" value="add category"></input>
    <!-- <button type="submit" form="add-cat" formaction="index.php?action=add-category" formmethod="post">add</button> -->
</div>