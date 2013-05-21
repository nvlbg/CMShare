                                <div id="content">
                                    <div id="search-orders">
                                        <a href="<?php echo PATH . 'search/?for=' . $for . '&order=1&desc=' . $desc; ?>" title="Order by title" class="<?php if(isset($arrows[0])) { echo $arrows[0]; } ?>">Title</a>
                                        <a href="<?php echo PATH . 'search/?for=' . $for . '&order=2&desc=' . $desc; ?>" title="Order by date" class="<?php if(isset($arrows[1])) { echo $arrows[1]; } ?>">Date</a>
                                        <a href="<?php echo PATH . 'search/?for=' . $for . '&order=3&desc=' . $desc; ?>" title="Order by seen" class="<?php if(isset($arrows[2])) { echo $arrows[2]; } ?>">Seen</a>
                                        <a href="<?php echo PATH . 'search/?for=' . $for . '&order=4&desc=' . $desc; ?>" title="Order by comments" class="<?php if(isset($arrows[3])) { echo $arrows[3]; } ?>">Comments</a>
                                        
                                        
                                        <a href="<?php echo PATH; ?>search/advanced/" title="Advanced search" class="search-advanced">Advanced search</a>
                                    </div>
                                <?php
                                foreach($articles as $article)
                                {
                                ?>
                                    <article class="post">
                                        <header>
                                        <?php
                                            echo '<img class="authorAvatar" src="' . $article['avatar'] . '" alt="' . $article['username'] . '" />';
                                            echo '<h3><a href="' . PATH . 'article/' . $article['article_id'] . '" title="' . $article['title'] . '">' . $article['title'] . '</a></h3>';
                                            echo '<div class="article-meta"><ul><li class="article-date">' . $article['date_added'] . '</li> <li class="article-author"><a href="' . PATH . 'user/' . $article['author_id'] . '" title="' . $article['username'] . '">' . $article['username'] . '</a></li> <li class="article-category"><a href="' . PATH . 'category/' . $article['category_id'] . '" title="' . $article['category_name'] . '">' . $article['category_name'] . '</a></li> <li class="article-seen">' . $article['seen'] . '</li> <li class="article-comments"><a href="' . PATH . 'article/' . $article['article_id'] . '" title="' . $article['title'] . '">' . $article['comments_count'] . '</a></li></ul></div>';
                                        ?>
                                        </header>
                                        <section>
                                        <?php 
                                            echo '<p>' . $article['article'] . '...  <a href="' . PATH . 'article/' . $article['article_id'] . '" title="' . $article['title'] . '">' . $read . '</a></p>';
                                        ?>
					</section>
                                        <footer>
                                            <div class="tags">
                                                <span><?php echo $tags; ?> </span>
                                                <ul>
                                                    <?php
                                                    foreach ($article['tags'] as $k => $tag)
                                                    {
                                                        echo '<li><a href="' . PATH . 'tag/' . $k . '" title="' . $tag . '">' . $tag . '</a></li>';
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </footer>
                                    </article>
                                    <?php
                                    }
                                    ?>
                                    <?php if($paginator->hasPages()) { ?>
                                    <div id="pagination">
                                        <?php echo $paginator->buildLinks(); ?>
                                    </div>
                                    <?php } ?>
                                </div>