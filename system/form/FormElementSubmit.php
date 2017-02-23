<?php

namespace system\form;

use system\form\FormElement;

class FormElementSubmit extends FormElement
{
	/**
	 * Constructor
	 * @param mixed $params
	 */
	public function __construct($params = array())
	{
		parent::__construct($params);
	}
	
	/**
	 * Get the HTML code of the element
	 * @return string 
	 */
	public function getHtml()
	{
		$class = rtrim(' '.$this->class);
		
		if($this->readOnly || $this->form->readOnly)
		{
			$disabled = ' disabled="disabled"';
		}
		else
		{
			$disabled = '';
		}
		
		return
			'<div class="form-group form-group-sm">'.
				'<button id="'.$this->id.'" name="'.$this->id.'"'.$disabled.' type="submit" value="'.$this->value.'" form="'.$this->form->id.'" class="btn'.$class.'">'.$this->label.'</button>'.
			'</div>';
	}	
}
