                        <div id="userBox">
                            <div id="userInfo">
                                <img id="avatar" alt="<?php echo $_SESSION['user_info']['username']; ?>" src="<?php echo $avatar; ?>" width="80" height="80" />
                                <div id="otherInfo">
                                    <a href="<?php echo PATH; ?>user/<?php echo $_SESSION['user_info']['user_id'] . '/'; ?>" id="profileLink"><?php echo $_SESSION['user_info']['username']; ?></a>
                                    <a href="<?php echo PATH; ?>pm/" id="messages" class="<?php echo $msg_count == 0 ? 'no_message_icon' : 'message_icon'; ?>"><?php echo $msg_count; ?></a>
                                    <a href="<?php echo PATH; ?>settings/" id="profileSettings"><?php echo $settings; ?></a>
                                </div>
                                <a id="logout" href="<?php echo PATH; ?>login/logout/">&nbsp;</a>
                            </div>
                        </div>