<?php

namespace system\form;

use system\form\FormElement;

class FormElementPassword extends FormElement
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
		
		$errorClass = '';
		if($this->hasError())
		{
			$errorClass = ' has-error';
		}
		
		if($this->readOnly || $this->form->readOnly)
		{
			$readOnly = ' readonly="readonly"';
		}
		else
		{
			$readOnly = '';
		}
		
		return
			'<div class="form-group form-group-sm'.$errorClass.'">'.
				'<label for="'.$this->id.'" class="col-sm-2 control-label">'.$this->label.'</label>'.
				'<div class="col-sm-10">'.
					'<input id="'.$this->id.'" name="'.$this->id.'" value=""'.$readOnly.' type="password" class="form-control'.$class.'" />'.
				'</div>'.
				$this->getErrorHtml().
			'</div>';
	}	
}
