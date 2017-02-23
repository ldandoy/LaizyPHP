<?php

namespace system\form;

use system\form\FormElement;

class FormElementSelect extends FormElement
{
	/**
	 * Options
	 * array(array('name' => 'n', 'value' => 'v'), ...)
	 * @var mixed
	 */
	public $options = array();
	
	/**
	 * If user can select multiple value
	 * @var mixed
	 */
	public $multiple = false;
	
	/**
	 * Constructor
	 * @param mixed $params
	 */
	public function __construct($params = array())
	{
		parent::__construct($params);
		
		$this->options = isset($params['options']) ? $params['options'] : array();
		$this->multiple = isset($params['multiple']) ? $params['multiple'] : false;
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
		
		$name = $this->id;		
		$multiple = '';
		if($this->multiple == true)
		{
			$multiple = ' multiple="multiple"';
			$name .= '[]';
		}
		
		if($this->readOnly || $this->form->readOnly)
		{
			$disabled = ' disabled="disabled"';
		}
		else
		{
			$disabled = '';
		}
		
		$html = 
			'<div class="form-group form-group-sm'.$errorClass.'">'.
				'<label for="'.$this->id.'" class="col-sm-2 control-label">'.$this->label.'</label>'.
				'<div class="col-sm-10">'.
					'<select id="'.$this->id.'" name="'.$name.'"'.$multiple.$disabled.' class="form-control'.$class.'">';
		foreach($this->options as $o)
		{
			if((is_array($this->value) && in_array($o['value'], $this->value)) || $o['value'] == $this->value)
			{
				$selected = ' selected="selected"';
			}
			else
			{
				$selected = '';
			}
			$html .= '<option value="'.$o['value'].'"'.$selected.'>'.$o['name'].'</option>';
		}
		$html .= 
					'</select>'.
				'</div>'.
				$this->getErrorHtml().
			'</div>';
		
		return $html;
	}	
}
