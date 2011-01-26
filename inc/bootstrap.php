<?php

function __autoload($class)
{
	$prefix = 'class';
	$dir = '';
	$class = ucfirst($class);
	switch ( $class )
	{
		case 'Textile':
			$dir = strtolower($class) . DIRECTORY_SEPARATOR;
		default:
			include $dir . $prefix . $class . '.php';
	}
}

$config['source_dir'] = $config['textviewer_root'] . DIRECTORY_SEPARATOR . ( $config['source_dir'] ? $config['source_dir'] . DIRECTORY_SEPARATOR : '' );

$include_paths = array(
	get_include_path(),
	$config['textviewer_root'],
	$config['include_dir'],
);
set_include_path(implode(PATH_SEPARATOR, $include_paths));
unset($include_paths);
unset($config['textviewer_root']);
unset($config['include_dir']);

$tv = new TvController($config);

unset($config);
