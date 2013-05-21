<form class="form" method="POST" action="" >
    <p>
        <label for="admin-name">Admin name</label>
        <input type="text" name="admin-name" id="admin-name" value="<?php if(isset($inputs['admin-name'])) { echo $inputs['admin-name']; } ?>" />
        <span><?php echo $hints['admin-name']; ?></span>
    </p>
    <p>
        <label for="admin-pass">Admin password</label>
        <input type="password" name="admin-pass" id="admin-pass" value="<?php if(isset($inputs['admin-pass'])) { echo $inputs['admin-pass']; } ?>" />
        <span><?php echo $hints['admin-pass']; ?></span>
    </p>
    <p>
        <label>Sex: </label>
		<div style="display: inline-block;margin: 6px 3px 6px 0;">
			<input type="radio" name="sex" value="m" id="male" <?php if(!isset($inputs['sex']) || $inputs['sex'] == 'm'){ echo 'checked="checked"'; } ?>>
			<label style="width:70px;" for="male">Male</label>
		</div>
        <div style="display: inline-block;">
			<input type="radio" name="sex" value="f" id="female" <?php if(isset($inputs['sex']) && $inputs['sex'] == 'f'){ echo 'checked="checked"'; } ?>>
			<label style="width:auto;" for="female">Female</label>
		</div>
    </p>
    <input type="submit" value="<?php echo $finish; ?>" />
</form>