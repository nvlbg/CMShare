<section id="content">
    <?php
    foreach($comments as $comment)
    {
    ?>
    <div class="editComment">
        <a class="dateWritten" href="<?php echo PATH . 'article/' . $comment['article_id'] . '/'; ?>"><?php echo $comment['date_written'] ?></a> <?php if($comment['author_id'] == 0) { echo '<span class="commentAuthor">' . $comment['username'] . '</span>'; } else { echo '<a class="commentAuthor" href="' . PATH . 'user/' . $comment['author_id'] . '/">' . $comment['username'] . '</a>'; } ?> <a class="commentAuthor" style="margin-left: 10px;" href="<?php echo $comment['email']; ?>"><?php echo $comment['email']; ?></a>
        <a href="<?php echo PATH . 'admin/comments/edit/' . $comment['comment_id'] . '/'; ?>" class="editCommentButton"><?php echo $edit; ?></a>
        <p class="commentContent"><?php echo $comment['comment']; ?></p>
    </div>
    <?php
    }
    ?>
</section>