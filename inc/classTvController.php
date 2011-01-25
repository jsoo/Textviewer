<?php

class TvController
{
	// from config
	protected $default_lang;
	protected $textviewer_root;
	protected $source_dir;
	protected $snippets = array();
	
	protected $langs = array();
	protected $source_files = array();
	protected $lang;
	protected $source_file;
	protected $display_modes = array('web', 'html', 'source');
	protected $default_display_page;
	protected $default_display_mode;
	protected $page_title;
	protected $parsers = array();
	protected $script_filename;
	
	public function __construct($config)
	{
		$this->default_lang = $config['default_lang'];
		$this->textviewer_root = $config['textviewer_root'];
		$this->source_dir = $config['source_dir'];
		$this->snippets = $config['snippets'];
		
		$this->default_display_mode = current($this->display_modes);
		$this->script_filename = basename($_SERVER['SCRIPT_FILENAME']);
		if ( $this->script_filename === 'index.php' )
			$this->script_filename = '';
		
		foreach ( scandir($this->source_dir) as $file )
			if ( is_dir($file) && self::is_lang($file) )
				$this->langs[] = $file;
		if ( isset($_GET['lang']) && self::is_lang($_GET['lang']) )
			$this->lang = $_GET['lang'];
		else
			$this->lang = $this->default_lang;
		$this->source_files = $this->_get_source_files($this->lang);

		if ( $this->lang !== $this->default_lang )
		{
			$default_files = $this->_get_source_files($this->default_lang);
			foreach ( $default_files as $name => $file )
			{
				if ( empty($this->source_files[$name]) )
				{
					$file->set_lang($this->lang)->set_untranslated(true);
					$this->source_files[$name] = $file;
				}
			}
		}
		if ( $this->source_files )
		{
			foreach ( $this->source_files as $file )
				$sort[$file->name] = $file->sort_order;
			array_multisort($sort, $this->source_files);
		}
		
		foreach ( $this->snippets as $snippet )
			if ( isset($this->source_files[$snippet]) )
			{
				$this->$snippet = $this->source_files[$snippet];
				unset($this->source_files[$snippet]);
			}

		$this->default_display_page = current(array_keys($this->source_files));
		foreach ( $this->display_modes as $mode )
		{
			if ( isset($_GET[$mode]) )
			{
				if ( array_key_exists($_GET[$mode], $this->source_files) )
				{
					$this->display_mode = $mode;
					$this->display_page = $_GET[$mode];
					break;
				}
				else
				{
					$this->display_mode = $this->default_display_mode;
					$this->display_page = $this->default_display_page;
				}
			}
		}
		
		if ( empty($this->display_mode) )
		{
			$this->display_mode = reset($this->display_modes);
			$this->display_page = current(array_keys($this->source_files));
		}
		
		if ( $this->source_files )
		{
			$this->source_file = $this->source_files[$this->display_page];
			$this->page_title = $this->source_file->page_title;
		}
	}
	
	private function _get_source_files($lang)
	{
		$dir = $this->source_dir . DIRECTORY_SEPARATOR . $lang;
		if ( is_dir($dir) ) 
		{
			foreach ( scandir($dir) as $file )
			{
				if ( preg_match('/^(.+)\.([a-z]+)$/', $file, $match) )
				{
					list(, $name, $extension) = $match;
					if ( $this->_has_parser($extension) )
					{
						$files[$name] = new TvSourceFile($name, $lang . DIRECTORY_SEPARATOR . $file, $this->parsers[$extension], $lang);
					}
				}
			}
		}
		return empty($files) ? array() : $files;
	}
	
	private function _has_parser($type)
	{
		if ( ! isset($this->parsers[$type]) )
		{
			$this->parsers[$type] = new TvParser($type);
		}
		return $this->parsers[$type] instanceof TvParser;
	}
	
	public function __get($property)
	{
		$getter = 'get_' . $property;
		if ( method_exists($this, $getter) )
			return $this->$getter();
		if ( property_exists($this, $property) )
			return $this->$property;
	}
		
	public static function is_lang($lang)
	{
		return preg_match('/^[a-z]{2,2}(-[a-z]{2,2}|)$/', $lang);
	}
	
	public function pagelink($file, $mode, $text = '')
	{
		if ( ! $text ) $text = $mode;
		$qs[] = $mode . '=' . $this->source_files[$file]->name;
		if ( $this->lang !== $this->default_lang )
			$qs[] = 'lang=' . $this->lang;
		$qs = '?' . implode('&amp;', $qs);
		return '<a href="./' . $this->script_filename . $qs . '">' . $text . '</a>';
	}
}