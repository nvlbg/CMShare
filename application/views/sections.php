                        <section id="sideBars" <?php if($no_sections) { echo 'style="display:none;"'; } ?>>
				<!--<aside class="sideBar">
					
				</aside>
				<aside class="sideBar">
					
				</aside>-->
                                <?php
                                foreach($section as $s)
                                {
                                ?>
                                <aside class="sideBar">
					<?php
                                        echo $s->toHTML();
                                        ?>
				</aside>
                                <?php
                                }
                                ?>
			</section>