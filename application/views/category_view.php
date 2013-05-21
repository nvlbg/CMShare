			<div id="content">
                            <h2 class="h2heading"><?php echo 'Category - ' . $articles[0]['category_name']; ?></h2>
                            <?php
                            if(isset($articles)) {
                            foreach($articles as $article) { 
                            ?>
                            <article class="post">
                                <header>
                                    <img class="authorAvatar" src="<?php echo $article['author_avatar']; ?>" alt="<?php echo $article['username']; ?>" width="44" height="44" />
                                    <h3><a href="<?php echo PATH . 'article/' . $article['article_id']; ?>" title="<?php echo $article['title']; ?>"><?php echo $article['title']; ?></a></h3>
                                    <div class="article-meta"><ul><li class="article-date"><?php echo $article['date_added']; ?></li> <li class="article-author"><a href="<?php echo PATH . 'user/' . $article['author_id']; ?>" title="<?php echo $article['username']; ?>"><?php echo $article['username']; ?></a></li> <li class="article-category"><a href="<?php echo PATH . 'category/' . $article['category_id']; ?>" title="<?php echo $article['category_name']; ?>"><?php echo $article['category_name']; ?></a></li> <li class="article-seen"><?php echo $article['seen']; ?></li> <li class="article-comments"><a href="<?php echo PATH . 'article/' . $article['article_id']; ?>" title="<?php echo $article['title']; ?>"><?php echo $article['comments_count']; ?></a></li></ul></div>
                                </header>
                                <section>
                                    <p><?php echo $article['article']; ?> ...  <a href="<?php echo PATH . 'article/' . $article['article_id'] . '/'; ?>" title="<?php echo $article['title']; ?>"><?php echo $read; ?></a></p>
                                </section>
                                <footer>
                                    <div class="tags">
                                        <span><?php echo $tags_m; ?></span>
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
                            <?php } if($paginator->hasPages()) { ?>
                            <div id="pagination">
                                <?php echo $paginator->buildLinks(); ?>
                            </div>
                            <?php } ?>
                            
                            <?php } else { ?>
                                <h3 class="h3heading"><?php echo $no_articles; ?></h3>
                            <?php } ?>
			</div>