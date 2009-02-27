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
interface Phorm_Field_Interface
{
	public function load();

	public function save($value);

	public function validate($value);

	public function set_custom_validation($validation, $additional = FALSE);

	public function get_id();

}
