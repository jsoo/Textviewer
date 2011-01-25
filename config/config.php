<?php

$config = array(

	/* 
	Default viewing language
	Must match name of directory holding source files for this language
	Must be in an ISO language code format, e.g. 'en' or 'en-gb'
	*/
	'default_lang' => 'en',


	/* 
	Parent directory for source files, relative to textviewer root
	i.e., where 'en' and other source file directories live
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
	
	
	/*
	Set this to 1 to use Markdown Extra syntax for Markdown files
	(see <http://michelf.com/projects/php-markdown/extra/>)
	Leave at 0 to use standard Markdown syntax
	*/
	'MarkdownExtra' => 1,
	
	
	/*
	SmartyPants filter for Markdown files:
		0: disabled
		1: standard ( -- => em dash )
		2: en-dash support ( em --- dash, en -- dash )
		3: en-dash alternate ( em -- dash, en --- dash )
	*/
	'SmartyPants' => 1,
	
	
	/*
	SmartyPants Typographer: Michel Fortin's extended SmartyPants.
	Base options same as for SmartyPants, above.
	If both are enabled, this one takes precedence.
	
	You can also enter a configuration string for more options;
	see <http://michelf.com/projects/php-smartypants/typographer/>
	*/
	'SmartyPantsTypographer' => 0,

);

/* 
You won't need to change these unless you are moving files around
*/
$config['textviewer_root'] = dirname(dirname(__FILE__));
$config['include_dir'] = $config['textviewer_root'] . DIRECTORY_SEPARATOR . 'inc';

