<div id="content">
    <div id="pm-box" class="no-sections">
        <nav class="nav-secondary">
            <ul>
                <?php
                foreach($pm_menu as $key => $value)
                {
                    $state = $key == $active ? 'class="nav-secondary-active"' : '';
                    echo '<li><a href="' . PATH . 'pm/' . $key . '/" ' . $state . ' >' . $value . '</a></li>';
                }
                ?>
            </ul>
            <a href="<?php echo PATH . 'pm/send/'; ?>" id="pm-send">Send</a>
        </nav>
        <?php
        for($i = 0; $i < $messages['cnt']; $i++)
        {
        ?>
        <div class="pm-message">
                <img src="<?php echo $messages['avatar'][$i]; ?>" alt="<?php echo $messages['username'][$i]; ?>" width="44" height="44" />
                <a href="<?php echo PATH . 'user/' . $messages['user_id'][$i] . '/';?>" class="pm-username"><?php echo $messages['username'][$i]; ?></a>
                <div class="pm-short">
                    <?php if(!$messages['read'][$i]) { echo '<b>'; } ?><a href="<?php echo PATH . 'pm/message/' . $messages['message_id'][$i] . '/'; ?>" class="pm-title"><?php echo $messages['title'][$i]; ?></a><?php if(!$messages['read'][$i]) { echo '</b>'; } ?>
                    <p><?php echo $messages['message'][$i]; ?></p>
                </div>
                <a class="pm-delete" href="<?php echo PATH . 'pm/delete/' . $messages['message_id'][$i] . '/'; ?>"><?php echo $delete; ?></a>
                <span class="pm-message-date"><?php echo $messages['date_written'][$i]; ?></span>
        </div>
        <?php
        }
        ?>
    </div>
</div>