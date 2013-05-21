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
    <form action="<?php echo PATH . 'admin/users/add/'; ?>" method="POST">
        <p>
            <label for="r-username"><?php echo $labels['username']; ?></label>
            <input type="text" name="r-username" value="<?php if(isset($inputs['r-username'])) { echo $inputs['r-username']; } ?>" />
        </p>
        <p>
            <label for="r-password"><?php echo $labels['password']; ?></label>
            <input type="password" name="r-password" value="<?php if(isset($inputs['r-password'])) { echo $inputs['r-password']; } ?>" />
        </p>
        <p>
            <label for="re-password"><?php echo $labels['re-pass']; ?></label>
            <input type="password" name="re-password" value="<?php if(isset($inputs['re-password'])) { echo $inputs['re-password']; } ?>" />
        </p>
        <p>
            <label for="email"><?php echo $labels['email']; ?></label>
            <input type="text" name="email" value="<?php if(isset($inputs['email'])) { echo $inputs['email']; } ?>" />
        </p>
        <p>
            <label for="re-email"><?php echo $labels['re-email']; ?></label>
            <input type="text" name="re-email" value="<?php if(isset($inputs['re-email'])) { echo $inputs['re-email']; } ?>" />
        </p>
        <p>
            <label for="sex"><?php echo $labels['sex']; ?></label>
            <input type="radio" name="sex" value="m" id="male" <?php if(!isset($inputs['sex']) || $inputs['sex'] == 'm'){ echo 'checked="checked"'; } ?>><span style="width:70px;" for="male"><?php echo $labels['male']; ?></span>
            <input type="radio" name="sex" value="f" id="female" <?php if(isset($inputs['sex']) && $inputs['sex'] == 'f'){ echo 'checked="checked"'; } ?>><span style="width:auto;" for="female"><?php echo $labels['female']; ?></span>
        </p>
        <p>
            <label for="permissions"><?php echo $labels['permissions']; ?></label>
            <select name="permissions">
                <option value="m"><?php echo $labels['moderator']; ?></option>
                <option value="n" <?php if(isset($inputs['permissions']) && $inputs['permissions'] == 'n') { echo 'selected'; } ?>><?php echo $labels['normal']; ?></option>
            </select>
        </p>
        
        <input type="hidden" name="check" value="<?php echo $check; ?>">
        <input type="submit" value="<?php echo $labels['add']; ?>" />
    </form>
</section>