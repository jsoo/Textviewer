<?php

class TvTheme
{
	const VIEW_FILE_EXT = '.tpl.php';
	
	protected $theme;
	protected $TvController;
	protected $rel_path;
	
	public function __construct($theme, $TvController)
	{
		$this->theme = $theme;
		$this->TvController = $TvController;
		$this->rel_path = 'themes' . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR;
	}
	
	public function __get($member)
	{
		if ( method_exists($this, $member) )
			return $this->$member();
		
		return $this->render($member);
	}
	
	public function render($view)
	{
		// make each user-declared snippet available in the template
		// as a TvSourceFile with the same name as the snippet
		foreach ( $this->TvController->snippets as $snippet )
			$$snippet = $this->TvController->$snippet;

		$tv = $this->TvController;
		$content = $tv->display_file;
		$pages = $tv->source_files;
		$theme = $this;
		ob_start();
			@include $this->rel_path . $view . self::VIEW_FILE_EXT;
		ob_end_flush();
	}
	
	public function css($name = '')
	{
		$file = $this->rel_path . ( $name ? $name : $this->theme ) . '.css';
		return '<link rel="stylesheet" type="text/css" href="' . $file . "\" />\n";
	}
}