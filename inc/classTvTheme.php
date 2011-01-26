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
	
	public function __get($property)
	{
		
	}
	
	public function render($view)
	{
		$tv = $this->TvController;
		$theme = $this;
		ob_start();
			include $this->rel_path . $view . self::VIEW_FILE_EXT;
		ob_end_flush();
	}
	
	public function css($file = '')
	{
		$file = $this->rel_path . ( $file ? $file : $this->theme ) . '.css';
		echo '<link rel="stylesheet" type="text/css" href="', $file, "\" />\n";
	}
}