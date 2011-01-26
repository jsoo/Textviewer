<?php
if ( count($tv->langs) > 1 ) : 
?>
<form name="select_lang" action="./<?php echo $tv->script_filename; ?>" method="get"><div>
<input type="hidden" name="<?php echo $tv->display_mode; ?>" value="<?php echo $tv->display_page; ?>" />
<select name="lang" onchange="select_lang.submit()">
<?php
	foreach ( $tv->langs as $lang ) :
		$selected = $lang === $tv->lang ? ' selected="selected"' : '';
		echo "<option{$selected}>{$lang}</option>\n";
	endforeach;
?>
</select>
</div></form>
<?php 
endif; 
?>