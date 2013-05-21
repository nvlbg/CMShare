                        <div id="userBox" style="max-width: 390px;">
                            <form method="POST" action="<?php echo PATH; ?>login/">

                                <p class="loginField">
                                    <label for="username" ><?php echo $username; ?></label>
                                    <input type="text" placeholder="<?php echo $username; ?>" name="username" value="<?php if(isset($user_input)){ echo $user_input; } ?>" id="username" class="inputField" />
                                </p>

                                <p class="loginField">
                                    <label for="password" ><?php echo $password; ?></label>
                                    <input type="password" placeholder="<?php echo $password; ?>" name="password" id="password" class="inputField" />
                                </p>

                                <p><a href="<?php echo PATH . 'register/';?>" title=""><?php echo $register; ?></a></p>
                                
                                <p style="float:right;position:relative;bottom:33px;">
                                    <input type="submit" value="<?php echo $login; ?>" class="inputButton" />
                                </p>

                            </form>
                        </div>