<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" onkeyup="autoComplete('search',this);" /><input type="submit" id="searchsubmit" value="Search" /></div>
<div id="search"></div>
</form>
