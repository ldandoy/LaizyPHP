<?php

namespace system\form;

use system\form\FormElement;

class FormElementCheckbox extends FormElement
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
	 * Load value from post data
	 * @return void
	 */
	public function loadValue()
	{
		if(isset($this->form->data[$this->id]) && $this->form->data[$this->id] == '1')
		{
			$this->value = '1';
		}
		else
		{
			$this->value = '0';
		}
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
		
		if($this->value == '1')
		{
			$checked = ' checked="checked"';
		}
		else
		{
			$checked = '';
		}
		
		$html =
			'<div class="form-group form-group-sm'.$errorClass.'">'.
				'<label for="'.$this->id.'" class="col-sm-2 control-label">'.$this->label.'</label>'.
				'<div class="col-sm-1">';
		if($this->readOnly || $this->form->readOnly)
		{
			$html .=
					'<input value="1"'.$checked.' disabled="disabled" type="checkbox" class="form-control'.$class.'" />'.
					'<input id="'.$this->id.'" name="'.$this->id.'" type="hidden" value="'.$this->value.'" />';
		}
		else
		{
			$html .=
					'<input id="'.$this->id.'" name="'.$this->id.'" value="1"'.$checked.' type="checkbox" class="form-control'.$class.'" />';
		}
		$html .=
				'</div>'.
				$this->getErrorHtml().
			'</div>';
		
		return $html;
	}	
}
