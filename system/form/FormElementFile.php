<?php

namespace system\form;

use system\form\FormElement;

class FormElementFile extends FormElement
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
				'<label for="'.$this->id.'" class="col-sm-2 control-label">'.$this->label.'</label>'.
				'<div class="col-sm-10">'.
					'<input id="'.$this->id.'" name="'.$this->id.'"'.$disabled.' type="file" class="form-control'.$class.'" />'.
				'</div>'.
				$this->getErrorHtml().
			'</div>';
	}	
}
