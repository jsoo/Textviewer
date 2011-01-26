<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>TextViewer: <?php echo $tv->page_title; ?></title>
<?php echo $theme->css; ?>
</head>
<body>
<?php 
echo $tagline;
echo $theme->menu;
if ( $content->is_untranslated ) echo $translate; 
?>
<div id="<?php echo $tv->display_mode; ?>">
<?php if ( $content ) : switch ( $tv->display_mode ) :
	case 'web':
		echo $content;
		break;
	case 'html':
		echo "<pre><code>\n", $content->html, "</code></pre>\n";
		break;
	case 'source':
		echo "<pre>\n", htmlspecialchars($content->source), "</pre>\n";
endswitch; endif; ?>
<?php echo $footer; ?>
</div>
</body>
</html>
