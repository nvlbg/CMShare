                        <div id="content">
                            <?php
							foreach($articles as $article) {
							?>
							<article class="post">
								<header>
									<img class="authorAvatar" src="<?php echo $article['author_avatar']; ?>" alt="<?php echo $article['username']; ?>" width="44" height="44" />
									<h3><a href="<?php echo PATH . 'article/' . $article['article_id'] . '/'; ?>" title="<?php echo $article['title']; ?>"><?php echo $article['title']; ?></a></h3>
									<div class="article-meta"><ul><li class="article-date"><?php echo $article['date_added']; ?></li> <li class="article-author"><a href="<?php echo PATH . 'user/' . $article['author_id'] . '/'; ?>" title="<?php echo $article['username']; ?>"><?php echo $article['username']; ?></a></li> <li class="article-category"><a href="<?php echo PATH . 'category/' . $article['category_id'] . '/'; ?>" title="<?php echo $article['category_name']; ?>"><?php echo $article['category_name']; ?></a></li> <li class="article-seen"><?php echo $article['seen']; ?></li> <li class="article-comments"><a href="<?php echo PATH . 'article/' . $article['article_id']; ?>" title="<?php echo $article['title']; ?>"><?php echo $article['comments_count']; ?></a></li></ul></div>
								</header>
								<section>
									<p><?php echo $article['article']; ?> ...  <a href="<?php echo PATH . 'article/' . $article['article_id'] . '/'; ?>" title="<?php echo $article['title']; ?>"><?php echo $read; ?></a></p>
								</section>
								<?php if($article['tags']) { ?>
								<footer>
									<div class="tags">
										<span><?php echo $tags; ?></span>
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
								<?php } ?>
							</article>
							<?php } if($paginator->hasPages()) { ?>
							<div id="pagination">
								<?php echo $paginator->buildLinks(); ?>
							</div>
							<?php } ?>
                        </div>