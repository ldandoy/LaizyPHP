<?php

namespace system\form;

use system\form\FormElement;

class FormElementCheckboxGroup extends FormElement
{
	/**
	 * Options
	 * array(array('name' => 'n', 'value' => 'v'), ...)
	 * @var mixed
	 */
	public $options = array();
	
	/**
	 * Constructor
	 * @param mixed $params
	 */
	public function __construct($params = array())
	{
		parent::__construct($params);
		
		$this->options = isset($params['options']) ? $params['options'] : array();
	}
	
	/**
	 * Load value from post data
	 * @return void
	 */
	public function loadValue()
	{
		parent::loadValue();
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
				'<div class="col-sm-10">';
		foreach($this->options as $o)
		{					
			if(is_array($this->value) && in_array($o['value'],$this->value))
			{
				$checked = ' checked="checked"';
				$readOnlyValue = $o['value'];
			}
			else
			{
				$checked = '';
				$readOnlyValue = '';
			}
			$html .=
				'<label for="'.$this->id.'_'.$o['value'].'" class="checkbox-inline">';
			if($this->readOnly || $this->form->readOnly)
			{				
				$html .=
					'<input value="'.$o['value'].'"'.$checked.' type="checkbox" class="'.$class.'" />'.$o['name'];
			}
			else
			{
				$html .=
					'<input id="'.$this->id.'_'.$o['value'].'" name="'.$this->id.'[]" value="'.$o['value'].'"'.$checked.' type="checkbox" class="'.$class.'" />'.$o['name'];
			}
				'</label>';
			if($this->readOnly || $this->form->readOnly)
			{
				$html .=
					'<input id="'.$this->id.'_'.$o['value'].'" name="'.$this->id.'[]" type="hidden" value="'.$readOnlyValue.'" />';
			}
		}
		$html .= 
				'</div>'.
				$this->getErrorHtml().
			'</div>';
		
		return $html;
	}	
}
