<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package    Scaffolding
 * @author     Michal Hordecki
 * @copyright  (c) 2009 Michal Hordecki
 * @license    MIT
 */

class Bound_String_Field_Core
{
	protected $name;
	protected $value;

	protected $field;

	public function __construct($field, $result)
	{
		$this->field = $field;
		$this->name = $field->getName();
		$name = $this->name;
		$this->value = $result->$name;

	}

	public function getName()
	{
		return $this->name;
	}

	public function get()
	{
		return $this->value;
	}

	public function set($value)
	{
		if($this->validate($value))
			$this->storage->save($value);
		else
			throw 1;
	}

	public function isVisible($visibility)
	{
		return TRUE;
	}

	public function __toString()
	{
		return strval($this->value);
	}

	public function getWidget($visibility)
	{
		switch($visibility)
		{
		case FIELD_VISIBILITY_OVERVIEW:
			return new Basic_Widget($this);
			break;
		}
	}

}
