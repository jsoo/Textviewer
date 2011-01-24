<?php

function __autoload($class)
{
	switch ( $class )
	{
		default:
			include 'class' . ucfirst($class) . '.php';
	}
}

$include_paths = array(
	get_include_path(),
	$config['textviewer_root'],
	$config['include_dir'],
	$config['include_dir'] . DIRECTORY_SEPARATOR . $config['source_language'],
);

if ( $config['source_dir'] )
	$include_paths[] = $config['source_dir'] = $config['textviewer_root'] . DIRECTORY_SEPARATOR . $config['source_dir'];
else
	$config['source_dir'] = $config['textviewer_root'];

set_include_path(implode(PATH_SEPARATOR, $include_paths));

$tv = new TvController($config);

unset($config);
