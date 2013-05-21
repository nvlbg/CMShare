<form class="form" method="POST" action="">
    <p>
        <label for="site-name">Site name</label>
        <input type="text" name="site-name" id="site-name" value="<?php if(isset($inputs['site-name'])) { echo $inputs['site-name']; } ?>" />
        <span><?php echo $hints['site-name']; ?></span>
    </p>
    <p>
        <label for="index-page">Index page</label>
        <input type="text" name="index-page" id="index-page" value="<?php if(isset($inputs['index-page'])) { echo $inputs['index-page']; } else { echo 'home'; } ?>" />
        <span><?php echo $hints['index-page']; ?></span>
    </p>
    <p>
        <label for="path">Path to the site</label>
        <input type="text" name="path" id="path" value="<?php if(isset($inputs['path'])) { echo $inputs['path']; } ?>" />
        <span><?php echo $hints['path']; ?></span>
    </p>
    <p>
        <label for="timezone">Default timezone</label>
        <input type="text" name="timezone" id="timezone" value="<?php if(isset($inputs['timezone'])) { echo $inputs['timezone']; } else { echo 'Europe/Sofia'; } ?>" />
        <span><?php echo $hints['timezone']; ?></span>
    </p>
    <input type="submit" value="<?php echo $next; ?>" />
</form>