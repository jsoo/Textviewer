<div id="menu">
<?php if ( $pages ) : ?>
<dl id="file-menu">
<?php foreach ( $pages as $name => $page ) :
		if ( $content->name === $name ) :
			echo '<dt class="here">', $page->page_title, '</dt>';
			foreach ( $tv->display_modes as $mode ) :
				if ( $mode === $tv->display_mode && $tv->display_page === $name ) :
					echo '<dd class="here">', $mode, '</dd>';
				else :
					echo '<dd>', $tv->pagelink($name, $mode), '</dd>';
				endif;
			endforeach;
		else :
			$class = $page->is_untranslated ? ' class="untranslated"' : '';
			echo "<dt{$class}>", $tv->pagelink($name, 'web', $page->page_title), '</dt>';
		endif;
	endforeach; ?>
</dl>
<?php 
endif; 
echo $theme->lang_select;
?>
</div>
