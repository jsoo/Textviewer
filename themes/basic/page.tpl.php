<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>TextViewer: <?php echo $content->page_title; ?></title>
<?php echo $theme->css; ?>
</head>
<body>
<?php 
echo $tagline;				// the 'tagline' snippet (as HTML)
echo $theme->menu;			// i.e., render menu.tpl.php
if ( $content->is_untranslated ) echo $translate; 
?>
<div id="<?php echo $tv->display_mode; ?>">
<?php if ( $content ) : switch ( $tv->display_mode ) :
	case 'web':
		echo $content;		// shortcut for $content->web
		break;
	case 'html':
		echo "<pre><code>\n", $content->html, "</code></pre>\n";
		break;
	case 'source':
		echo "<pre>\n", htmlspecialchars($content->source), "</pre>\n";
endswitch; endif; ?>
<?php echo $footer;			// the 'footer' snippet ?>
</div>
</body>
</html>
