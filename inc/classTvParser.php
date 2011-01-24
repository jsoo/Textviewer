<?php

class TvParser
{
	protected $lang;
	protected $parser;
	
	public function __construct($lang)
	{
		switch ( $lang )
		{
			case 'textile':
				$this->lang = $lang;
				$this->parser = new Textile;
		}
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
		}
	}
	
	
}