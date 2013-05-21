<div id="content">
    <article class="article">
        <header>
        <?php
            echo '<img src="' . $author_avatar . '" width="44" height="44" alt="' . $username . '" />';
            echo '<h2>' . $title . '</h2>';
            echo '<div class="article-meta"><ul><li class="article-date">' . $date_added . '</li> <li class="article-author"><a href="' . PATH . 'user/' . $author_id . '" title="' . $username . '">' . $username . '</a></li> <li class="article-category"><a href="' . PATH . 'category/' . $category_id . '" title="' . $category_name . '">' . $category_name . '</a></li> <li class="article-seen">' . $seen . '</li> <li class="article-comments"><span>' . $comments_count . '</span></li></ul></div>';
        ?>
        </header>
        <section>
            <?php echo $article; ?>
        </section>
        <footer>
            <div class="tags">
                <span><?php echo $tags_m; ?> </span>
                <ul>
                    <?php
                    foreach ($tags as $k => $tag)
                    {
                        echo '<li><a href="' . PATH . 'tag/' . $k . '" title="' . $tag . '">' . $tag . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </footer>
    </article>
    <div id="comments">
        <?php
        echo '<h3>' . $comms . '</h3>';
        for($i = 0; $i < $comments_count; $i++)
        {
        ?>
        <div class="comment">
            <img src="<?php echo $comments['author_avatar'][$i]; ?>" width="44" height="44" />
            <?php if($comments['author'][$i] !== NULL) { ?>
                <a href="<?php echo PATH; ?>user/<?php echo $comments['author_id'][$i] . '/'; ?>" class="c-username"><?php echo $comments['author'][$i]; ?></a>
            <?php } else { ?>
                <span class="c-name"><?php echo $comments['name'][$i]; ?></span>
            <?php } ?>
            <span class="c-written"><?php echo $comments['written'][$i]; ?></span>
            <p><?php echo $comments['comment'][$i]; ?></p>
        </div>
        <?php
        }
        ?>
    </div>
    <?php if(isset($comment_error)) { ?>
        <p class="comment-error"><?php echo $comment_error; ?></p>
    <?php } ?>
    <div id="commentForm">
        <form method="POST" action="<?php echo PATH; ?>article/comment/<?php echo $article_id; ?>" id="commentForm">
            <?php if($comment_data === TRUE) { ?>
            <p>
                <input type="text" name="cm-name" id="cm-name" <?php if(isset($post['cm-name'])) { echo 'value="' . $post['cm-name'] . '"'; } ?> />
                <label for="cm-name">Your name</label>
            </p>
            <p>
                <input type="text" name="cm-email" id="cm-email" <?php if(isset($post['cm-email'])) { echo 'value="' . $post['cm-email'] . '"'; } ?> />
                <label for="cm-email">Your email (will not be shown)(required)</label>
            </p>
            <?php } ?>
            <p>
                <textarea name="cm-comment" id="cm-comment"><?php if(isset($post['cm-comment'])) { echo $post['cm-comment']; } ?></textarea>
            </p>
            <input type="hidden" name="check" value="1" />
            <input type="submit" value="Send!" />
        </form>
    </div>
</div>