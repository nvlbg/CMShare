<section id="content">
    <form method="POST" action="<?php echo PATH . 'admin/article/delete/'; ?>">
        <table class="editTable">
            <thead>
                <tr><th>&nbsp;</th><th style="width:600px;"><?php echo $labels['title']; ?></th><th><?php echo $labels['edit']; ?></th></tr>
            </thead>
            <tbody>
            
            <?php
            foreach($articles as $article)
            {
                echo '<tr><td class="smallCell"><input type="checkbox" name="delete[]" value="' . $article['id'] . '" /></td><td><a href="' . PATH . 'article/' . $article['id'] . '/" class="editTitle">' . $article['title'] . '</a></td><td><a href="' . PATH . 'admin/article/edit/' . $article['id'] . '/" class="editButton">' . $labels['edit'] . '</a></td></tr>';
            }
            ?>
            
            </tbody>
        </table>
        <?php if($paginator->hasPages()) { ?>
        <div id="pagination">
            <?php echo $paginator->buildLinks(); ?>
        </div>
        <?php } ?>
        <input type="hidden" name="check" value="<?php echo $check; ?>" />
        <input type="submit" value="<?php echo $labels['delete']; ?>" />
    </form>
</section>