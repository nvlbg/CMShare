<div id="content">
    <h3 style="margin: 0;">Search for:</h3>
    <form method="GET" action="<?php echo PATH; ?>search/advanced/" id="search-advanced" class="form">
        <p>
            <label for="any">Any of these</label>
            <input type="text" name="any" id="any" />
        </p>
        <p>
            <label for="each">Each of these</label>
            <input type="text" name="each" id="each" />
        </p>
        <p>
            <label for="none">None of these</label>
            <input type="text" name="none" id="none" />
        </p>
        <input type="submit" value="Search" />
    </form>
</div>