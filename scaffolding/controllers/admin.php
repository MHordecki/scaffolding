<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Default Kohana controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Ph_Controller extends Controller{

	// Disable this controller when Kohana is set to production mode.
	// See http://docs.kohanaphp.com/installation/deployment for more details.
	const ALLOW_PRODUCTION = FALSE;

	// Set the name of the template to use
	public $template = 'kohana/template';

	public function index()
	{
		echo "<pre>\n";
		$hehe = 'jeden';

		$st = new Phorm_Field_String(new Phorm_Storage_Variable($hehe), 'hehe');

		echo var_dump(array('storage' => $st->load(), 'variable' => $hehe));
		$hehe = 'dwa';
		echo var_dump(array('storage' => $st->load(), 'variable' => $hehe));
		$st->save('trzy');
		echo var_dump(array('storage' => $st->load(), 'variable' => $hehe));
		
	}

} // End Welcome Controller
