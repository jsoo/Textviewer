<?php
	
class TvSourceFile
{
	protected $page_title;
	protected $sort_order;

	private $_name;
	private $_source;
	private $_html;
	private $_parser;
	private $_TvController;
	private $_lang;
	private $_untranslated = false;
	
	public function __construct($name, $file_path, $parser, $lang, $TvController)
	{
		$this->_name = $name;
		$this->_parser = $parser;
		$this->_TvController = $TvController;
		$this->_lang = $lang;
		if ( file_exists($file_path) )
		{
			$this->_source = file_get_contents($file_path);
			$lines = explode("\n", $this->_source);
			foreach ( $lines as $line )
			{
				if ( preg_match('/^\s*$/', $line) )
					break;
				foreach ( $this as $meta => $value )
				{
					if ( substr($line, 0, strlen($meta)) === $meta )
					{
						$this->$meta = substr($line, strlen($meta) + strlen(' => '));
					}
				}
			}
		}
		if ( ! $this->page_title )
			$this->page_title = $this->name;
		if ( ! $this->sort_order )
			$this->sort_order = $this->name;
	}
	
	public function __toString() { return $this->_get_html(); }
	
	public function __get($property)
	{
		$getter = 'get_' . $property;
		if ( method_exists($this, $getter) )
			return $this->$getter();
	}
	
	public function get_page_title() { return $this->page_title; }
	
	public function get_sort_order() { return $this->sort_order; }
	
	public function get_name() { return $this->_name; }
	
	public function get_html() { return htmlspecialchars($this->_get_html()); }
	
	public function get_web() { return $this->_get_html(); }
	
	public function get_source() { return $this->_source; }
	
	public function get_is_untranslated() { return $this->_untranslated; }
	
	public function get_lang() { return $this->_lang; }
	
	public function get_anchor($mode = '', $text = '')
	{
		return $this->_TvController->pagelink($this, $mode, $text);
	}
	
	public function set_lang($lang)
	{
		$this->_lang = $lang;
		return $this;
	}
	
	public function set_untranslated($bool)
	{
		$this->_untranslated = $bool;
		return $this;
	}
	
	private function _get_html()
	{
		if ( ! $this->_html )
		{
			$this->_html = $this->_parse();
		}
		return $this->_html;
	}
	
	private function _parse()
	{
		return $this->_parser->parse($this->_source);
	}
	
}

