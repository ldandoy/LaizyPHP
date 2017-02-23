<?php

namespace system\form;

use system\form\FormElement;

class FormElementHidden extends FormElement
{
	/**
	 * Constructor
	 * @param mixed $params
	 */
	public function __construct($params = array())
	{
		parent::__construct($params);
	}
	
	public function getHtml()
	{
		return '<input id="'.$this->id.'" name="'.$this->id.'" value="'.$this->value.'" type="hidden" />';
	}
	
}
