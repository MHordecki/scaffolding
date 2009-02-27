<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package Scaffolding
 * @author Michal Hordecki
 * @license GNU LGPL
 */
class Scaffolding_Field_Core
{
	public static function factory($model, $name, $type)
	{
		switch($type)
		{
		case 'varchar':
			return new String_Field($model, $name);
			break;
		case 'int':
			return new Int_Field($model, $name);
			break;
		default:
			return 'zonk!';
			break;
		}
	}
}


