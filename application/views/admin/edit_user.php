<section id="content">
    <?php
    if(isset($success))
    {
        echo '<p id="success">' . $success . '</p>';
    }
    else if(isset($errors))
    {
        echo '<div id="errors">';
        
        foreach($errors as $err)
        {
            echo '<p>' . $err . '</p>';
        }
        
        echo '</div>';
    }
    ?>
    
    <div id="userInfo">
        <img src="<?php echo $user_info['avatar']; ?>" width="100" height="100" alt="<?php echo $user_info['username']; ?>" />
        <p> <span><?php echo $labels['user_id']; ?></span> <?php echo $user_info['id']; ?> </p>
        <p> <span><?php echo $labels['username']; ?></span> <?php echo $user_info['username']; ?> </p>
        <p> <span><?php echo $labels['email']; ?></span> <?php echo $user_info['email']; ?> </p>
        <p> <span><?php echo $labels['sex']; ?></span> <?php echo $user_info['sex']; ?> </p>
    </div>
    
    <form action="<?php echo PATH . 'admin/users/edit/' . $user_info['id'] . '/'; ?>" method="POST">
        <p>
            <label for="fname"><?php echo $labels['fname']; ?></label>
            <input type="text" name="fname" value="<?php if(isset($inputs['fname'])) { echo $inputs['fname']; } else { echo $user_info['fname']; } ?>" />
        </p>
        <p>
            <label for="lname"><?php echo $labels['lname']; ?></label>
            <input type="text" name="lname" value="<?php if(isset($inputs['lname'])) { echo $inputs['lname']; } else { echo $user_info['lname']; } ?>" />
        </p>
        <p>
            <label for="description"><?php echo $labels['desc']; ?></label>
            <textarea name="description"><?php if(isset($inputs['description'])) { echo $inputs['description']; } else { echo $user_info['description']; } ?></textarea>
        </p>
        <p>
            <label for="permissions"><?php echo $labels['permissions']; ?></label>
            <select name="permissions">
                <option value="n"><?php echo $labels['normal']; ?></option>
                <option value="m" <?php if($user_info['permissions'] == 'm') { echo 'selected'; } ?>><?php echo $labels['moderator']; ?></option>
            </select>
        </p>
        <p>
            <label for="remove-avatar"><?php echo $labels['rem-avatar']; ?></label>
            <span style="color: #555;font-weight: bold;"><?php echo $labels['yes']; ?></span> <input type="checkbox" name="remove-avatar" value="1" />
        </p>
        <p>
            <a href="<?php echo PATH . 'admin/comments/user/' . $user_id . '/'; ?>"><?php echo $labels['edit_coms']; ?></a>
        </p>

        <input type="hidden" name="check" value="<?php echo $check; ?>">
        <input type="submit" value="<?php echo $labels['button']; ?>" />
    </form>
</section>