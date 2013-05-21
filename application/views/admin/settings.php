<section id="content">

    <?php

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

    <form action="<?php echo PATH . 'admin/settings/'; ?>" method="POST">
        <p>
            <label for="controller"><?php echo $labels['control']; ?></label>
            <input type="text" name="controller" value="<?php echo isset($inputs['controller']) ? $inputs['controller'] : $default_controller; ?>" />
        </p>
        <p>
            <label for="posts"><?php echo $labels['posts']; ?></label>
            <input type="text" name="posts" value="<?php echo isset($inputs['posts']) ? $inputs['posts'] : $per_pages; ?>" />
        </p>
        <p>
            <label for="timezone"><?php echo $labels['timezone']; ?></label>
            <input type="text" name="timezone" value="<?php echo isset($inputs['timezone']) ? $inputs['timezone'] : $default_timezone; ?>" />
        </p>
        <p>
            <label for="footer"><?php echo $labels['footer']; ?></label>
            <input type="text" name="footer" value="<?php echo isset($inputs['footer']) ? $inputs['footer'] : $footer; ?>" />
        </p>
        
        <input type="submit" value="<?php echo $labels['save']; ?>" />
    </form>
</section>