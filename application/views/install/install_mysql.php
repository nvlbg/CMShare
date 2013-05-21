<p style="float: left; margin: 30px 0 0 45px;">
    Mysqli: <?php if($mysqli) { echo '<span style="color: green; margin-left: 152px;">installed</span>'; } else { echo '<span style="color: red; margin-left: 152px;">Not installed. Please, install it before continue.</span>'; } ?>
</p>
<form class="form" method="POST" action="">
    <p>
        <label for="mysql-server">Mysql Server</label>
        <input type="text" name="mysql-server" id="mysql_server" value="<?php if(isset($inputs['mysql-server'])) { echo $inputs['mysql-server']; } ?>" />
        <span><?php echo $hints['mysql-server']; ?></span>
    </p>
    <p>
        <label for="mysql-username">Username</label>
        <input type="text" name="mysql-user" id="mysql_user" value="<?php if(isset($inputs['mysql-user'])) { echo $inputs['mysql-user']; } ?>" />
        <span><?php echo $hints['mysql-user']; ?></span>
    </p>
    <p>
        <label for="mysql-pass">Mysql Password</label>
        <input type="password" name="mysql-pass" id="mysql_pass" value="<?php if(isset($inputs['mysql-pass'])) { echo $inputs['mysql-pass']; } ?>" />
        <span><?php echo $hints['mysql-pass']; ?></span>
    </p>
    <p>
        <label for="mysql-db">Mysql Database</label>
        <input type="text" name="mysql-db" id="mysql_db" value="<?php if(isset($inputs['mysql-db'])) { echo $inputs['mysql-db']; } ?>" />
        <span><?php echo $hints['mysql-db']; ?></span>
    </p>
    <input type="submit" value="<?php echo $next; ?>" />
</form>