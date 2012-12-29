<?php

namespace Everzet\Jade;

class Engine
{
	private $dumper;
	private $parser;
	private $jade;
	private $templatePath;

	public function __construct()
	{
		$this->dumper = new Dumper_PHPDumper();

		$this->dumper->registerVisitor('tag', new Visitor_AutotagsVisitor());
		$this->dumper->registerFilter('javascript', new Filter_JavaScriptFilter());
		$this->dumper->registerFilter('cdata', new Filter_CDATAFilter());
		$this->dumper->registerFilter('php', new Filter_PHPFilter());
		$this->dumper->registerFilter('style', new Filter_CSSFilter());

		$this->parser = new Parser(new Lexer_Lexer());
		$this->jade   = new Jade($this->parser, $this->dumper);
	}

	public function render($jadeFileName)
	{
		return $this->jade->render(file_get_contents(__DIR__ . '/../../..' . $this->templatePath . $jadeFileName));
	}

	public function setTemplatePath($newTempatePath)
	{
		return $this->templatePath = $newTempatePath;
	}
}