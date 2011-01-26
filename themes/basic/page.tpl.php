<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>TextViewer: <?php echo $tv->page_title; ?></title>
<?php $theme->css(); ?>
</head>
<body>
<?php echo $tv->tagline ? $tv->tagline->web : ''; ?>
<div id="menu">
<?php if ( $tv->source_files ) : ?>
<dl id="file-menu">
<?php foreach ( $tv->source_files as $filename => $file ) :
		if ( $tv->display_page === $file->name ) :
			echo '<dt class="here">', $file->page_title, '</dt>';
			foreach ( $tv->display_modes as $mode ) :
				if ( $mode === $tv->display_mode && $tv->display_page === $file->name ) :
					echo '<dd class="here">', $mode, '</dd>';
				else :
					echo '<dd>', $tv->pagelink($file->name, $mode), '</dd>';
				endif;
			endforeach;
		else :
			$class = $file->is_untranslated() ? ' class="untranslated"' : '';
			echo "<dt{$class}>", $tv->pagelink($file->name, 'web', $file->page_title), '</dt>';
		endif;
	endforeach; ?>
</dl>
<?php endif;
if ( count($tv->langs) > 1 ) : ?>
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
<?php endif; ?>
</div>
<?php if ( $tv->display_file->is_untranslated() ) echo $tv->translate->web; ?>
<div id="<?php echo $tv->display_mode; ?>">
<?php if ( $tv->display_file ) : switch ( $tv->display_mode ) :
	case 'web':
		echo $tv->display_file->web;
		break;
	case 'html':
		echo "<pre><code>\n", $tv->display_file->html, "</code></pre>\n";
		break;
	case 'source':
		echo "<pre>\n", htmlspecialchars($tv->display_file->source), "</pre>\n";
endswitch; endif; ?>
<?php echo $tv->footer ? $tv->footer->web : ''; ?>
</div>
</body>
</html>
