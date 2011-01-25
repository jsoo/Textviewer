<?php

class TvParser
{
	protected $lang;
	protected $parser;
	protected $TvController;
	
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
				if ( $TvController->SmartyPants )
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
				if ( $this->TvController->SmartyPants )
					return SmartyPants($out, $this->TvController->SmartyPants);
				return $out;
		}
	}
	
	
}