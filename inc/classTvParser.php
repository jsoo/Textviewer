<?php

class TvParser
{
	protected $lang;
	protected $parser;
	protected $TvController;
	protected $post_markdown_filter;
	
	public function __construct($lang, $TvController)
	{
		switch ( $lang )
		{
			case 'textile':
				$this->lang = $lang;
				$this->parser = new Textile;
				break;
			case 'markdown':
				$this->lang = $lang;
				$this->parser = new Markdown_Parser;
				if ( $this->post_markdown_filter = $TvController->SmartyPantsTypographer )
					include 'smartypantstypographer/smartypants.php';
				elseif ( $this->post_markdown_filter = $TvController->SmartyPants )
					include 'smartypants/smartypants.php';
				break;
		}
		$this->TvController = $TvController;
	}
	
	public function __get($property)
	{
		switch ( $property )
		{
			case 'lang':
				return $this->lang;
			case 'parser':
				return $this->parser;
		}
	}
	
	public function parse($source)
	{
		switch ( $this->lang )
		{
			case 'textile':
				return $this->parser->TextileThis($source);
			case 'markdown':
				$out = $this->parser->transform($source);
				if ( $this->post_markdown_filter )
					return SmartyPants($out, $this->post_markdown_filter);
				return $out;
		}
	}
	
	
}