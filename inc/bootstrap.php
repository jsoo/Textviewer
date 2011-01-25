<?php

function __autoload($class)
{
	$prefix = 'class';
	$dir = '';
	$class = ucfirst($class);
	switch ( $class )
	{
		case 'Markdown_Parser':
			$class = 'markdown';
			$prefix = '';
		case 'Textile':
			$dir = strtolower($class) . DIRECTORY_SEPARATOR;
		default:
			include $dir . $prefix . $class . '.php';
	}
}

$include_paths = array(
	get_include_path(),
	$config['textviewer_root'],
	$config['include_dir'],
);

if ( $config['source_dir'] )
	$include_paths[] = $config['source_dir'] = $config['textviewer_root'] . DIRECTORY_SEPARATOR . $config['source_dir'];
else
	$config['source_dir'] = $config['textviewer_root'];

set_include_path(implode(PATH_SEPARATOR, $include_paths));

unset($include_paths);

$tv = new TvController($config);

unset($config);
