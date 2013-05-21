<section id="content">
    <form method="POST" action="<?php echo PATH . 'admin/users/delete/'; ?>">
        <table class="editTable">
            <thead>
                <tr><th>&nbsp;</th><th style="width:600px;"><?php echo $labels['username']; ?></th><th><?php echo $labels['edit']; ?></th></tr>
            </thead>
            <tbody>
            
            <?php
            foreach($users as $user)
            {
                echo '<tr><td class="smallCell"><input type="checkbox" name="delete[]" value="' . $user['id'] . '" /></td><td><a href="' . PATH . 'user/' . $user['id'] . '/" class="editTitle">' . $user['name'] . '</a></td><td><a href="' . PATH . 'admin/users/edit/' . $user['id'] . '/" class="editButton">' . $labels['edit'] . '</a></td></tr>';
            }
            ?>
            
            </tbody>
        </table>
        <?php if($paginator->hasPages()) { ?>
        <div id="pagination">
            <?php echo $paginator->buildLinks(); ?>
        </div>
        <?php } ?>
        
        <input type="hidden" value="<?php echo $check; ?>" />
        <input type="submit" value="<?php echo $labels['delete']; ?>" />
    </form>
</section>