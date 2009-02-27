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
interface Phorm_Storage_Interface
{
	public function load();

	public function save($value);
}
