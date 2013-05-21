		<div id="notes">
			<section>
				<h3><?php echo $labels['users']; ?></h3>
                                <?php
                                foreach($last_users as $user)
                                {
                                    echo '<p class="newUser"><span>' . $user['id'] . '</span> <a href="' . PATH . 'user/' . $user['id'] . '/">' . $user['name'] . '</a></p>';
                                }
                                ?>
			</section>
			<section>
				<h3><?php echo $labels['comments']; ?></h3>
                                <?php
                                foreach($last_comments as $comment)
                                {
                                    echo '<p class="newComment"><span class="dateWritten">' . $comment['date_written'] . '</span>';
                                    if($comment['author_id'] != 0)
                                    {
                                        echo '<a href="' . PATH . 'user/' . $comment['author_id'] . '/" class="commentAuthor">' . $comment['username'] . '</a>';
                                    }
                                    else
                                    {
                                        echo '<a href="#" class="commentAuthor">' . $comment['username'] . '</a>';
                                    }
                                    echo '<a href="' . PATH . 'article/' . $comment['article_id'] . '/" class="commentContent">' . $comment['comment'] . '</a></p>';
                                }
                                ?>
			</section>
		</div>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	
	<script type="text/javascript">
		var PATH = '<?php echo PATH; ?>';
		!window.jQuery && document.write('<script type="text/javascript" src="' + PATH + 'js/jquery.min.js"><\/script>');
	</script>
	
	<!-- CKEditor -->
	<script src="<?php echo PATH . 'js/ckeditor/ckeditor.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo PATH . 'js/ckeditor/adapters/jquery.js'; ?>" type="text/javascript"></script>
	
	<!-- jQuery plugins -->
	<script src="<?php echo PATH . 'js/plugins/plugins.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo PATH . 'js/plugins/farbtastic.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo PATH . 'js/plugins/jquery-ui-1.8.17.custom.min.js'; ?>" type="text/javascript"></script>

        <?php
        if(isset($script))
        {
            echo '<script src="' . $script . '" type="text/javascript"></script>';
        }
        ?>

	<script type="text/javascript">
            $(document).ready(function() {
                $('#main-menu ul li').hover(function () {
                    $(this).find('ul').stop(true, true).animate({opacity: 'show', height: 'show'}, 200);
                }, function () {
                    $(this).children('ul').stop(true, true).animate({opacity: 'hide', height: 'hide'}, 200);
                });
                
                //$('#notes').sortable();
            });
	</script>
</body>
</html>