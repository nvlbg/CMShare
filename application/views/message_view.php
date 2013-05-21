<div id="content">
    <div class="mv-message no-sections">
        <img class="mv-avatar" src="<?php echo $message['avatar']; ?>" alt="<?php echo $message['sender']; ?>" width="44" height="44" />
        <h3><?php echo $message['title']; ?></h3>
        <div>
            <span class="mv-sender"><a href="<?php echo PATH . 'user/' . $message['sender_id'] .  '/'; ?>"><?php echo $message['sender']; ?></a></span>
            <span class="mv-date"><?php echo $message['date_written']; ?></span>
        </div>
        <div class="mv-msg">
            <?php
            if($message['is_your'])
            {
            ?>
            <div class="msg-actions">
                <a href="<?php echo PATH . 'pm/delete/' . $message['id'] . '/'; ?>" class="msg-delete icon">Delete</a>
                <a href="<?php echo PATH . 'pm/resend/' . $message['id'] . '/'; ?>" class="msg-resend icon">Resend</a>
            </div>
            <?php
            }
            ?>
            <p>
                <?php echo $message['message']; ?>
            </p>
        </div>
    </div>
</div>