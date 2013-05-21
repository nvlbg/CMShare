<section id="content">
    <?php
    foreach($messages as $msg) { ?>
    <div class="feedback">
        <h2><?php echo $msg['title']; ?></h2>
        <p><?php echo $labels['from']; ?> <span><?php echo $msg['name']; ?></span></p>
        <p><?php echo $labels['email']; ?> <span><?php echo $msg['email']; ?></span></p>
        <p class="feedback-message"><?php echo $msg['message']; ?></p>
    </div>
    <?php } ?>
    <?php if($paginator->hasPages()) { ?>
    <div id="pagination">
        <?php echo $paginator->buildLinks(); ?>
    </div>
    <?php } ?>
</section>