<div id="content">
    <div class="no-sections">
        <div class="user-header">
            <img class="user-avatar" src="<?php echo $user_avatar; ?>" alt="<?php echo $username; ?>" width="100" height="100" />
            <?php if($online) { ?>
            <span class="online"><?php echo $labels['online']; ?></span>
            <?php } ?>
            <h2><?php echo $username; ?></h2>
            <div class="user-meta">
                <p><?php echo $labels['registered_on']; ?><span><?php echo $date_registred; ?></span></p>
                <p><?php echo $labels['sex']; ?><span style="color: <?php echo $sex_color; ?>;"><?php echo $sex; ?></span></p>
            </div>
        </div>
        <?php if($description != '') { ?>
        <div class="user-description">
            <?php echo $description; ?>
        </div>
        <?php } ?>
        <div class="user-information">
            <?php if($other_user) { ?>
            <div class="user-actions">
                <a href="<?php echo PATH; ?>pm/send/<?php echo $user_id; ?>/" title="Send message" class="user-send icon"><?php echo $labels['pm']; ?></a>
                <a href="<?php echo PATH; ?>block/<?php echo $user_id; ?>/" title="Block this person" class="user-block icon"><?php echo $labels['block']; ?></a>
            </div>
            <?php } ?>
            <p><span class="user-data"><?php echo $labels['first']; ?></span> <span><?php echo $first_name; ?></span></p>
            <p><span class="user-data"><?php echo $labels['last']; ?></span> <span><?php echo $last_name; ?></span></p>
            <p><span class="user-data"><?php echo $labels['comms']; ?></span> <span><?php echo $comments; ?></span></p>
            <p><span class="user-data"><?php echo $labels['permissons']; ?></span> <span><?php echo $permissions; ?></span></p>
        </div>
    </div>
</div>