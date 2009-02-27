<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * $Id$
 *
 * @package    Phorm
 * @author     Michal Hordecki
 * @copyright  (c) 2009 Michal Hordecki
 * @license    MIT
 */

class Phorm_Field_String implements Phorm_Field_Interface
{
	protected $storage;

	protected $custom_validation;

	protected $custom_validation_is_additional;

	protected $id;
	
	public function __construct($storage, $id)
	{
		$this->storage = $storage;
		$this->id = $id;

		$this->custom_validation = NULL;
		$this->custom_validation_is_additional = FALSE;
	}

	public function load()
	{
		return $this->storage->load();
	}

	public function save($value)
	{
		if($this->validate($value))
			$this->storage->save($value);
		else
			throw 1;
	}

	public function builtin_validation($value)
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

	public function set_custom_validation($validation, $additional = FALSE)
	{
		$this->custom_validation = $validation;
		$this->custom_validation_is_additional = $additional;
	}

	public function get_id()
	{
		return $this->id;
	}

}
