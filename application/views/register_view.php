                    <div id="content">
                        <?php
                        if(isset($errors))
                        {
                            foreach($errors as $v)
                            {
                                echo '<div class="error"><p>' . $v . '</p></div>';
                            }
                        }
                        ?>
                        <form method="POST" action="<?php echo PATH; ?>register/register" id="registerForm" class="form">
                            <p>
                                <label for="r-username"><?php echo $labels['username']; ?><span class="required">*</span>: </label>
                                <input type="text" value="<?php if(isset($inputs['r-username'])){ echo $inputs['r-username']; } ?>" name="r-username" id="r-username" class="registerField">
                            </p>
                            <p>
                                <label for="r-password"><?php echo $labels['password']; ?><span class="required">*</span>: </label>
                                <input type="password" value="<?php if(isset($inputs['r-password'])){ echo $inputs['r-password']; } ?>" name="r-password" id="r-password" class="registerField">
                            </p>
                            <p>
                                <label for="re-password"><?php echo $labels['re-pass']; ?><span class="required">*</span>: </label>
                                <input type="password" value="<?php if(isset($inputs['re-password'])){ echo $inputs['re-password']; } ?>" name="re-password" id="re-password" class="registerField">
                            </p>
                            <p>
                                <label for="email"><?php echo $labels['email']; ?><span class="required">*</span>: </label>
                                <input type="text" value="<?php if(isset($inputs['email'])){ echo $inputs['email']; } ?>" name="email" id="email" class="registerField">
                            </p>
                            <p>
                                <label for="re-email"><?php echo $labels['re-email']; ?><span class="required">*</span>: </label>
                                <input type="text" value="<?php if(isset($inputs['re-email'])){ echo $inputs['re-email']; } ?>" name="re-email" id="re-email" class="registerField">
                            </p>
                            <p>
                                <label for="first-name"><?php echo $labels['first-name']; ?>: </label>
                                <input type="text" value="<?php if(isset($inputs['first-name'])){ echo $inputs['first-name']; } ?>" name="first-name" id="first-name" class="registerField">
                            </p>
                            <p>
                                <label for="last-name"><?php echo $labels['last-name']; ?>: </label>
                                <input type="text" value="<?php if(isset($inputs['last-name'])){ echo $inputs['last-name']; } ?>" name="last-name" id="last-name" class="registerField">
                            </p>
                            <p style="margin-left:20px;">
                                <span style="display:inline-block;width:200px;margin-left:-20px;"><?php echo $labels['sex']; ?><span class="required">*</span>: </span>
                                <input type="radio" name="sex" value="m" id="male" <?php if(!isset($inputs['sex']) || $inputs['sex'] == 'm'){ echo 'checked="checked"'; } ?>><label style="width:70px;" for="male"><?php echo $labels['male']; ?></label>
                                <input type="radio" name="sex" value="f" id="female" <?php if(isset($inputs['sex']) && $inputs['sex'] == 'f'){ echo 'checked="checked"'; } ?>><label style="width:auto;" for="female"><?php echo $labels['female']; ?></label>
                            </p>
                            <p>
                                <label for="description"><?php echo $labels['desc']; ?>: </label>
                                <textarea name="description" id="description"><?php if(isset($inputs['description'])){ echo $inputs['description']; } ?></textarea>
                            </p>
                            <p>
                                <input type="submit" value="Register">
                            </p>
                        </form>
                    </div>