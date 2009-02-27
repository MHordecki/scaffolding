<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Inspects Kohana Model classes and gathers info about fields, relationships etc.
 * It provides compatibility with both standard Model and Kohana 2.1 ORM objects.
 * 
 * @warning Model_Inspector should not be instantiated by user. Use Model_Inspect class instead.
 * @package Scaffolding
 * @author Michal Hordecki
 * @license GNU LGPL
 */
class Bound_Kohana_Model_Adaptor_Core
{
	protected $model;
	protected $db;

	protected $fields;

	protected $raw_data;

	function __construct($model, $data)
	{
		$this->model = $model;
		$this->raw_data = $data;

		foreach($this->model->getFields() as $field)
		{
			if(!is_object($field)) continue;
			$f = $field->bind($this->raw_data);
			$this->fields[$f->getName()] = $f;
		}
	}


	function getFields($visibility)
	{
		$ret = array();
		foreach($this->fields as $field)
		{
			if($field->isVisible($visibility))
				$ret[] = $field;
		}

		return $ret;
	}

}


