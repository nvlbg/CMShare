<section id="content">
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
    <form action="<?php echo PATH . 'admin/article/write/'; ?>" method="POST">
        <p>
            <label for="title"><?php echo $labels['title']; ?></label>
            <input type="text" name="title" <?php if(isset($inputs['title'])) { echo 'value="' . $inputs['title'] . '"'; } ?> />
        </p>
        <p>
            <label for="article"><?php echo $labels['article']; ?></label>
            <textarea name="article" id="article_textarea"><?php if(isset($inputs['article'])) { echo $inputs['article']; } ?></textarea>
        </p>
        <p>
			<?php
			if(count($cats) == 0)
			{
				echo $categories_error;
			}
			else
			{
				echo '<label for="category">' . $labels['category'] . '</label>';
				echo '<select name="category">';
				foreach($cats as $cat)
				{
					echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
				}
				echo '</select>';
			}
			?>
        </p>
        <p>
            <label><?php echo $labels['tags']; ?></label>
            <input type="text" name="tags" <?php if(isset($inputs['tags'])) { echo 'value="' . $inputs['tags'] . '"'; } ?> />
            <span class="hint"><?php echo $labels['tags_hint']; ?></span>
        </p>
        
        <input type="hidden" name="check" value="<?php echo $check; ?>" />
        <input type="submit" value="<?php echo $labels['post']; ?>" />
    </form>
</section>