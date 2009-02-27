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
class Phorm_Storage_Variable implements Phorm_Storage_Interface
{
	protected $datasource;

	public function __construct(&$variable)
	{
		$this->datasource = &$variable;
	}

	public function load()
	{
		return $this->datasource;
	}

	public function save($value)
	{
		$this->datasource = $value;
	}
}
