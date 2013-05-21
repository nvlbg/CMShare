<div id="content">
    <?php
    if(isset($errors))
    {
        echo '<div class="error">';
        foreach($errors as $v)
        {
            echo '<p>' . $v . '</p>';
        }
        echo '</div>';
    }
    ?>
    <form method="POST" action="<?php echo PATH; ?>contact/send/" id="contactForm" class="form">
        <p>
            <label for="c-name"><?php echo $labels['name']; ?><span class="required">*</span>: </label>
            <input type="text" name="c-name" value="<?php if(isset($inputs[0])) { echo $inputs[0]; } ?>" id="c-name">
        </p>
        <p>
            <label for="c-email"><?php echo $labels['email']; ?><span class="required">*</span>: </label>
            <input type="text" name="c-email" value="<?php if(isset($inputs[1])) { echo $inputs[1]; } else { echo $email_field; } ?>" id="c-email">
        </p>
        <p>
            <label for="c-title"><?php echo $labels['title']; ?><span class="required">*</span>: </label>
            <input type="text" name="c-title" value="<?php if(isset($inputs[2])) { echo $inputs[2]; } ?>" id="c-title">
        </p>
        <p>
            <label for="c-message"><?php echo $labels['message']; ?><span class="required">*</span>: </label>
            <textarea name="c-message" id="c-message"><?php if(isset($inputs[3])) { echo $inputs[3]; } ?></textarea>
        </p>
        <p>
            <input type="submit" value="Send">
        </p>
    </form>
</div>