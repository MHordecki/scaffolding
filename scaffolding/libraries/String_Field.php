<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package    Scaffolding
 * @author     Michal Hordecki
 * @copyright  (c) 2009 Michal Hordecki
 * @license    MIT
 */

class String_Field_Core
{
	protected $name;
	protected $model;

	protected $custom_validation;
	protected $custom_validation_is_additional;

	public function __construct($model, $name)
	{
		$this->model = $model;
		$this->name = $name;

		$this->custom_validation = NULL;
		$this->custom_validation_is_additional = false;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getPrettyName()
	{
		return $this->name;
	}

	public function isVisible($visibility)
	{
		return 1;
	}

	public function builtinValidation($value)
	{
		return TRUE;
	}

	public function validate($value)
	{
		if($this->custom_validation)
		{
			if(!$this->custom_validation->validate($value))
				return FALSE;

			if(!$this->custom_validation_is_additional)
				return TRUE;
			
		}

		return $this->builtin_validation($value);
	}

	public function setCustomValidation($validation, $additional = FALSE)
	{
		$this->custom_validation = $validation;
		$this->custom_validation_is_additional = $additional;
	}

	public function getQuery($qry)
	{
		$qry->fields(array($this->getName() => $this->model->getTableName() . '.' . $this->getName()));

		return $qry;
	}

	public function bind($result)
	{
		return new Bound_String_Field($this, $result);

	}

}
