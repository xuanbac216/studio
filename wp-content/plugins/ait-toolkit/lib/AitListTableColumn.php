<?php

/*
 * AIT Toolkit WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


/**
 * General column class for accessing column contents
 * Custom column classes are defined in admin/columns directory of framework
 */
class AitListTableColumn
{
	protected $name;
	protected $label;
	protected $sortable;
	protected $params;
	protected $metabox;


	public function __construct($name, $label, $sortable, $params = array(), $metabox = null)
	{
		$this->name     = $name;
		$this->label    = $label;
		$this->sortable = $sortable;
		$this->params   = $params;
		$this->metabox  = $metabox;
	}



	public function getName()
	{
		return $this->name;
	}



	public function hasLabel()
	{
		return !empty($this->label);
	}



	public function getLabel()
	{
		return $this->label;
	}



	public function isSortable()
	{
		return $this->sortable;
	}



	public function getMetabox()
	{
		return $this->metabox;
	}



	public function getValue($postId = 0)
	{
		return '';
	}
}
