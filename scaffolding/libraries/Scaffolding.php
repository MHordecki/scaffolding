<?php


class Scaffolding_Core
{
	protected $model;
	protected $views;

	function __construct($model)
	{
		$this->model = new Kohana_Model_Adaptor($model);
		$this->views = array('overview' => 'scaffolding/basic/overview');
	}

	public function setViewName($action, $name)
	{
		$this->views[$action] = $name;
	}

	protected function getViewName($action)
	{
		return $this->views[$action];
	}

	/**
	 * Action dispatcher.
	 */
	function scaffold($arguments)
	{
		$action = isset($arguments[0]) ? $arguments[0] : 'overview';

		switch($action)
		{
		case 'overview':
			$view = $this->action_overview();
			break;
		}

		$view = new View($this->getViewName($action), $view);

		return $view->render();
	}

	public function action_overview()
	{
		$rows = array();
		$view = array();

		foreach($this->model->getQuery()->execute() as $row)
		{
			$rows[] = $this->model->bind($row);
		}

		$view['fieldnames'] = array();
		foreach($this->model->getFields(FIELD_VISIBILITY_OVERVIEW) as $field)
		{
			$view['fieldnames'][] = $field->getName();
		}

		$view['data'] = array();
		foreach($rows as $row)
		{
			$output = array();
			foreach($row->getFields(FIELD_VISIBILITY_OVERVIEW) as $field)
			{
				$output[$field->getName()] = $field->getWidget(FIELD_VISIBILITY_OVERVIEW);
			}

			$view['data'][] = $output;
		}

		return $view;
	}
}

