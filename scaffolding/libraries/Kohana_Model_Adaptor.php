<?php defined('SYSPATH') or die('No direct script access.');

define('FIELD_VISIBILITY_ALL', 0);
define('FIELD_VISIBILITY_EDIT', 1);
define('FIELD_VISIBILITY_VIEW', 2);

define('FIELD_VISIBILITY_OVERVIEW', 100);
define('FIELD_VISIBILITY_SIMPLE', 101);

/**
 * Inspects Kohana Model classes and gathers info about fields, relationships etc.
 * It provides compatibility with both standard Model and Kohana 2.1 ORM objects.
 * 
 * @warning Model_Inspector should not be instantiated by user. Use Model_Inspect class instead.
 * @package Scaffolding
 * @author Michal Hordecki
 * @license GNU LGPL
 */
class Kohana_Model_Adaptor_Core
{
	protected $model;
	protected $db;

	protected $fields;

	protected $id;

	function __construct($model, $inspect = TRUE)
	{
		$this->model = $model;
		$this->db = Database::instance();

		if($inspect)
			$this->inspect();
	}

	protected function devour_property($object, $property)
	{
		if(!is_array($object))
			$object = (array) $object;

		$prot_prefix = chr(0).'*'.chr(0); // prefix for protected members
		$priv_prefix = chr(0).'X'.chr(0); // prefix for private members

		if(array_key_exists($property,$object))
			return $object[$property];

		if(array_key_exists($prot_prefix.$property,$object))
			return $object[$prot_prefix.$property];

		if(array_key_exists($priv_prefix.$property,$object))
			return $object[$priv_prefix.$property];

		return false;
	}

	public function getTableName()
	{
		$table = get_class($this->model);
		
		return inflector::plural(strtolower(substr($table, 0, -6)));
	}

	public function inspect()
	{
		//if(isset(self::$cached_fields[$model->getTableName()]))
		//	return self::$cached_fields[$model->getTableName()];

		$this->fields = array();

		$raw_fields = Database::instance()->field_data($this->getTableName());

		foreach($raw_fields as $raw_field)
		{
			$name = $raw_field->Field;
			$type = strtolower($raw_field->Type);
			if(strpos($type, '(') !== false)
				$type = substr($type, 0, strpos($type, '('));

			//var_dump(array($name, $type));
			$field = Scaffolding_Field::factory($this, $name, $type);
			$this->fields[$name] = $field;
			//var_dump($field);
		}

	}

	public function getFields($visibility = FIELD_VISIBILITY_ALL)
	{
		$res = array();
		foreach($this->fields as $field)
		{
			if(!is_object($field) or !$field->isVisible($visibility))
				continue;

			$res[] = $field;
		}

		return $res;
	}

	public function field($field)
	{
		return $this->fields[$field];
	}

	public function bind($result)
	{
		return new Bound_Kohana_Model_Adaptor($this, $result);
	}

	public function getQuery()
	{
		$qry = new Query();
		foreach($this->getFields() as $field)
		{
			if(!is_object($field)) continue;

			$qry = $field->getQuery($qry);
		}

		$qry->table($this->getTableName());

		return $qry;
	}
}


