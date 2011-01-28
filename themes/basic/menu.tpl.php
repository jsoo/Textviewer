<div id="menu">
<?php if ( $pages ) : ?>
<dl id="file-menu">
<?php foreach ( $pages as $name => $page ) :
		if ( $content->name === $name ) :
?>
	<dt class="here"><?php echo $page->page_title; ?></dt>
<?php
			foreach ( $tv->display_modes as $mode ) :
				if ( $mode === $tv->display_mode ) :
?>
	<dd class="here"><?php echo $mode ?></dd>
<?php
				else :
?>
	<dd><?php echo $tv->pagelink($name, $mode) ?></dd>
<?php
				endif;
			endforeach;
		else :
			$class = $page->is_untranslated ? ' class="untranslated"' : '';
?>
	<dt<?php echo $class; ?>><?php echo $tv->pagelink($name, 'web', $page->page_title); ?></dt>
<?php
		endif;
	endforeach; ?>
</dl>
<?php 
endif; 
echo $theme->lang_select;
?>
</div>
