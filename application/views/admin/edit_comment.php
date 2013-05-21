<section id="content">
    <form id="commentForm" action="<?php echo PATH . 'admin/comments/edit/' . $id . '/'; ?>" method="POST">
        <p>
            <textarea name="comment" id="comment"><?php echo $comment; ?></textarea>
        </p>

        <input type="submit" value="<?php echo $edit; ?>" />
    </form>
</section>