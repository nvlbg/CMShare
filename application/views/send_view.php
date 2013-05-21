<div id="content">
    <h3>Send message:</h3>
    <?php
    if(isset($errors))
    {
        echo '<div class="error">';
        foreach($errors as $err)
        {
            echo '<p class="error">' . $err . '</p>';
        }
        echo '</div>';
    }
    else if(isset($success))
    {
        echo '<p id="success">' . $success . '</p>';
    }
    ?>
    <form method="POST" action="<?php echo PATH . 'pm/send/'; ?>" id="send-message" class="form">
        <p>
            <label for="send-user">To:</label>
            <input type="text" name="send-user" id="send-user" <?php if(isset($inputs['send-user'])) { echo 'value="' . $inputs['send-user'] . '"'; } ?> />
        </p>
        <p>
            <label for="send-title">Title</label>
            <input type="text" name="send-title" id="send-title" <?php if(isset($inputs['send-title'])) { echo 'value="' . $inputs['send-title'] . '"'; } ?> />
        </p>
        <p>
            <label for="send-message">Message</label>
            <textarea name="send-message" id="send-message"><?php if(isset($inputs['send-message'])) { echo $inputs['send-message']; } ?></textarea>
        </p>
        <input type="submit" value="Send" />
    </form>
</div>