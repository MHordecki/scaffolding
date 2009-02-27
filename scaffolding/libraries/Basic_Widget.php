<?php


class Basic_Widget_Core
{
	protected $field;

	function __construct($field)
	{
		$this->field = $field;
	}

	public function render()
	{
		return strval($this->field->get());
	}
}

