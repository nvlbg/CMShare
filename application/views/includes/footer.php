            </div>
        </section>
	<footer id="footer" class="centered">
		<p><?php echo FOOTER; ?></p>
	</footer>
        
        <!-- jQuery and jQueryUI -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
        
        <!-- jQuery plugins -->
        <script src="<?php echo PATH . 'js/plugins/plugins.js'; ?>" type="text/javascript"></script>
        
        <!-- History.js -->
        <script src="<?php echo PATH . 'js/history.js/amplify.store.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo PATH . 'js/history.js/history.adapter.jquery.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo PATH . 'js/history.js/history.js'; ?>" type="text/javascript"></script>
        
        <script src="<?php echo PATH . 'js/spin.min.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo PATH . 'js/general.js'; ?>" type="text/javascript"></script>

        <?php
        if(isset($script))
        {
            echo '<script src="' . $script . '" type="text/javascript"></script>';
        }
        ?>

        <script type="text/javascript">
            var PATH = '<?php echo PATH; ?>';
            <?php if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === TRUE) { ?>
            var USER_INFO = {
                    username : "<?php echo $_SESSION['user_info']['username']; ?>",
                    user_id : "<?php echo $_SESSION['user_info']['user_id']; ?>",
                    avatar_path : "<?php echo Validate::getAvatarPath($_SESSION['user_info']['user_id'], 44); ?>"
                };
            <?php }?>
            
            !window.jQuery && document.write('<script type="text/javascript" src="' + path + 'js/jquery.min.js"><\/script>');
        </script>
</body>
</html>