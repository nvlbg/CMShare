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
	<form action="<?php echo PATH . 'admin/add_category/'; ?>" method="POST">
		<p>
			<label for="category"><?php echo $labels['name']; ?></label>
			<input type="text" name="category" <?php if(isset($input['category'])) { echo 'value="' . $input['category'] . '"'; } ?> />
		</p>
		<input type="hidden" name="check" value="<?php echo $check; ?>" />
		<input type="submit" value="<?php echo $labels['add']; ?>" />
	</form>
</section>