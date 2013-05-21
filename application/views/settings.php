<div id="content">
    <fieldset class="settingsField">
        <legend><?php echo $labels['l']['password']; ?></legend>
            <?php
            if(isset($changepass['success']))
            {
                echo '<p>' . $changepass['success'] . '</p>';
            }
            elseif (isset($changepass['errors']))
            {
                foreach ($changepass['errors'] as $err)
                {
                    echo '<p class="error">' . $err . '</p>';
                }
            }
            ?>
            <form class="form" method="POST" action="<?php echo PATH . 'settings/changepass/'; ?>">
                <p>
                    <label for="old-password"><?php echo $labels['pw']['old']; ?></label>
                    <input type="password" name="old-password" id="old-password" <?php if (isset($inputs['old-password'])) { echo 'value="' . $inputs['old-password'] . '"'; } ?> />
                </p>
                <p>
                    <label for="new-password"><?php echo $labels['pw']['new']; ?></label>
                    <input type="password" name="new-password" id="new-password" <?php if (isset($inputs['new-password'])) { echo 'value="' . $inputs['new-password'] . '"'; } ?> />
                </p>
                <p>
                    <label for="re-new-password"><?php echo $labels['pw']['re-new']; ?></label>
                    <input type="password" name="re-new-password" id="re-new-password" <?php if (isset($inputs['re-new-password'])) { echo 'value="' . $inputs['re-new-password'] . '"'; } ?> />
                </p>
                <input type="submit" value="<?php echo $labels['pw']['submit']; ?>" />
            </form>
        </fieldset>
        <fieldset class="settingsField">
        <legend><?php echo $labels['l']['profile']; ?></legend>
        <?php
        if(isset($changeprofile['success']))
        {
            foreach($changeprofile['success'] as $msg)
            {
                echo '<p>' . $msg . '</p>';
            }
        }
        if (isset($changeprofile['errors']))
        {
            foreach ($changeprofile['errors'] as $err)
            {
                echo '<p class="error">' . $err . '</p>';
            }
        }
        ?>
            <form class="form" method="POST" action="<?php echo PATH . 'settings/changeprofile/'; ?>">
                <?php if ($_SESSION['user_info']['fname'] == '') { ?>
                <p>
                    <label for="p-fname"><?php echo $labels['pr']['fname']; ?></label>
                    <input type="text" name="p-fname" id="p-fname" <?php if (isset($inputs['p-fname'])) { echo 'value="' . $inputs['p-fname'] . '"'; } ?> />
                </p>
                <?php } if ($_SESSION['user_info']['lname'] == '') { ?>
                <p>
                    <label for="p-lname"><?php echo $labels['pr']['lname']; ?></label>
                    <input type="text" name="p-lname" id="p-lname" <?php if (isset($inputs['p-lname'])) { echo 'value="' . $inputs['p-lname'] . '"'; } ?> />
                </p>
                <?php } ?>
                <p>
                    <label for="p-desc"><?php echo $labels['pr']['desc']; ?></label>
                    <textarea name="p-desc" id="p-desc"><?php if (isset($inputs['p-desc']) && $inputs['p-desc'] != '') { echo $inputs['p-desc']; } else { echo $_SESSION['user_info']['desc']; } ?></textarea>
                </p>
                <input type="hidden" name="check" value="1" />
                <input type="submit" value="<?php echo $labels['pr']['submit']; ?>" />
            </form>
        </fieldset>
        <fieldset class="settingsField">
        <legend><?php echo $labels['l']['avatar']; ?></legend>
        <?php
        if (isset($new_avatar['errors']))
        {
            foreach ($new_avatar['errors'] as $err)
            {
                echo '<p class="error">' . $err . '</p>';
            }
        }
        ?>
            <div id="response"></div>
            <div id="preview"></div>
            <div id="sqr">
                <label for="sqrdim"><?php echo $labels['a']['sqare']; ?></label>
                <input type="checkbox" id="sqrdim" />
            </div>
            <form class="form" method="POST" action="<?php echo PATH . 'settings/changeavatar/'; ?>" enctype="multipart/form-data" id="avatar-upload-form">
                <p>
                    <label for="u-avatar"><?php echo $labels['a']['new']; ?></label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input type="file" name="u-avatar" id="u-avatar" accept="image/gif, image/png, image/jpeg" />
                </p>
                <p><?php echo $labels['a']['allowed']; ?></p>
                <input type="submit" value="<?php echo $labels['a']['submit']; ?>" />
            </form>
        </fieldset>

       <section id="userStats">
           <h4><?php echo $labels['l']['logins']; ?></h4>
           <table>
               <tr><th><?php echo $labels['ll']['time']; ?></th><th><?php echo $labels['ll']['ip']; ?></th></tr>
               <?php
               for ($i = 0; $i < $rows; $i++) {
                   echo '<tr><td>' . $time[$i] . '</td><td>' . $ip[$i] . '</td></tr>';
               }
               ?>
            </table>
       </section>
</div>