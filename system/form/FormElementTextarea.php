<?php

namespace system\form;

use system\form\FormElement;

class FormElementTextarea extends FormElement
{
	/**
	 * Number of cols
	 * @var int
	 */
	public $cols = 40;
	
	/**
	 * Number of rows
	 * @var int
	 */
	public $rows = 5;
	
	/**
	 * Constructor
	 * @param mixed $params
	 */
	public function __construct($params = array())
	{
		parent::__construct($params);
		
		$this->cols = isset($params['cols']) ? $params['cols'] : 40;
		$this->rows = isset($params['rows']) ? $params['rows'] : 5;
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
			$errorClass = ' error';
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
					'<textarea id="'.$this->id.'" name="'.$this->id.'"'.$readOnly.' cols="'.$this->cols.'" rows="'.$this->rows.'" class="form-control'.$class.'">'.$this->value.'</textarea>'.
				'</div>'.
				$this->getErrorHtml().
			'</div>';
	}	
}
