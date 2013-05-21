<section id="content">
    <div id="articleMeta">
        <h2><?php echo $title; ?></h2>
        <ul>
            <li class="seen"><?php echo $seen; ?></li>
            <li class="date"><?php echo $date_added; ?></li>
        </ul>
    </div>
    
    <?php
    if(isset($success))
    {
        echo '<p id="success">' . $success . '</p>';
    }
    
    if(isset($errors))
    {
        echo '<div id="errors">';
        
        foreach($errors as $err)
        {
            echo '<p>' . $err . '</p>';
        }
        
        echo '</div>';
    }
    ?>
    
    <form method="POST" action="<?php echo PATH . 'admin/article/edit/'; ?>">
        <p>
            <label for="title"><?php echo $labels['title']; ?></label>
            <input type="text" name="title" value="<?php echo isset($inputs['title']) ? $inputs['title'] : $title; ?>" />
        </p>
        <p>
            <label for="article"><?php echo $labels['article']; ?></label>
            <textarea name="article" id="article_textarea"><?php echo isset($inputs['article']) ? $inputs['article'] : $article; ?></textarea>
        </p>
        <p>
            <label for="category"><?php echo $labels['category']; ?></label>
            <select name="category">
                <?php
                foreach($categories as $cat)
                {
                    echo '<option value="' . $cat['id'] . '"';
                    if($category_id == $cat['id']) { echo ' selected '; }
                    echo '>' . $cat['name'] . '</option>';
                }
                ?>
            </select>
        </p>
        <p>
            <label for="tags"><?php echo $labels['tags']; ?></label>
            <input type="text" name="tags" value="<?php echo isset($inputs['tags']) ? $inputs['tags'] : $tags; ?>" />
            <span class="hint"><?php echo $labels['tags_hint']; ?></span>
        </p>
        <p>
            <span style="color: #555;font-weight: bold;"><?php echo $labels['reset']; ?></span>
            <input type="checkbox" name="reset" value="1" />
        </p>
        
        <p>
            <a href="<?php echo PATH . 'admin/comments/article/' . $article_id . '/'; ?>"><?php echo $labels['edit_coms']; ?></a>
        </p>
        
        <input type="hidden" name="check" value="<?php echo $check; ?>" />
        <input type="hidden" name="article_id" value="<?php echo $article_id; ?>" />
        <input type="submit" value="<?php echo $labels['edit']; ?>" /> 
    </form>
</section>