<section id="content">
    <h2 id="sample" style="font-size: 60px;margin: 0;"><?php echo SITE_NAME; ?></h2>
    <form method="POST" action="<?php echo PATH . 'admin/appearance/'; ?>">
        <p>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?php echo SITE_NAME; ?>" />
        </p>
        <p>
            <label for="textColor">Title color</label>
            <input type="text" id="textColor" name="textColor" value="<?php echo LOGO_COLOR; ?>" />
            <div id="textColorBox" style="display: none;"></div>
        </p>
        <p>
            <label for="shadowColor">Shadow color</label>
            <input type="text" id="shadowColor" name="shadowColor" value="<?php echo LOGO_SHADOW; ?>" />
            <div id="shadowColorBox" style="display: none;"></div>
        </p>
        <p>
            <label for="shadowX">Shadow X</label>
            <input type="range" id="shadowX" name="shadowX" min="-50" value="<?php echo LOGO_SHADOWX; ?>" max="50" />
        </p>
        <p>
            <label for="shadowY">Shadow Y</label>
            <input type="range" id="shadowY" name="shadowY" min="-50" value="<?php echo LOGO_SHADOWY; ?>" max="50" />
        </p>
        <p>
            <label for="blur">Blur</label>
            <input type="range" id="blur" name="blur" value="<?php echo LOGO_BLUR; ?>" min="0" max="100" />
        </p>
        
        <input type="submit" value="Save" />
    </form>
</section>