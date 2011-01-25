<?php

function __autoload($class)
{
	if ( $class === 'Markdown_Parser' )
		$class = 'markdown';
	$include_path = get_include_path();
	foreach ( explode(PATH_SEPARATOR, $include_path) as $path )
	{
		if ( is_dir($path . DIRECTORY_SEPARATOR . $class) )
		{
			set_include_path($include_path . PATH_SEPARATOR . $path . DIRECTORY_SEPARATOR . $class);
			break;
		}
	}
	switch ( $class )
	{
		case 'markdown':
			include 'markdown.php';
			break;
		default:
			include 'class' . ucfirst($class) . '.php';
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
