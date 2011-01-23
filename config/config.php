<?php

$config = array(

	/*
	The markup language for this TextViewer, e.g., 'textile'
	The name must match the file extension for source files,
	parser class name, file, and directory (e.g. inc/textile/classTextile.php)
	*/
	'source_language' => 'textile',

	/* 
	Default viewing language
	Must match name of directory holding source files for this language
	Must be in an ISO language code format, e.g. 'en' or 'en-gb'
	*/
	'default_lang' => 'en-gb',


);

/* 
You won't need to change these unless you are moving files around
*/
$config['textviewer_dir'] = dirname(dirname(__FILE__));
$config['include_dir'] = $config['textviewer_dir'] . DIRECTORY_SEPARATOR . 'inc';


$include_paths = array(
	get_include_path(),
	$config['textviewer_dir'],
	$config['include_dir'],
	$config['include_dir'] . DIRECTORY_SEPARATOR . $config['source_language'],
);
set_include_path(implode(PATH_SEPARATOR, $include_paths));
