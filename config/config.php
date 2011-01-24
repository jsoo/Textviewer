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
	'default_lang' => 'en',


	/* 
	Parent directory for source files, relative to textviewer root
	i.e., where 'en-gb' and other lang directories live
	*/
	'source_dir' => '',
	
	
	/*
	List any common page elements here -- header & footer, tagline, messages ...
	TextViewer will scan each source directory for files with these names,
	and separate them from the main source files
	*/
	'snippets' => array(

// 		'header',
		'tagline',		// slogan to appear as a header
		'translate',	// message to show on untranslated files
 		'footer',		// page footer

	),
);

/* 
You won't need to change these unless you are moving files around
*/
$config['textviewer_root'] = dirname(dirname(__FILE__));
$config['include_dir'] = $config['textviewer_root'] . DIRECTORY_SEPARATOR . 'inc';

