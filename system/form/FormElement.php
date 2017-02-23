<?php

namespace system\form;

use system\form\Form;

define('FORMELEMENT_VALIDATION_REGEX', 0);
define('FORMELEMENT_VALIDATION_INT', 1);
define('FORMELEMENT_VALIDATION_FLOAT', 2);
define('FORMELEMENT_VALIDATION_DATETIME', 3);
define('FORMELEMENT_VALIDATION_DATE', 4);
define('FORMELEMENT_VALIDATION_TIME', 5);
define('FORMELEMENT_VALIDATION_EMAIL', 6);

/**
 * Class FormElement
 */
abstract class FormElement
{
	/**
	 * The id
	 * @var string
	 */
	public $id = '';

	/**
	 * The label
	 * @var string
	 */
	public $label = '';
	
	/**
	 * If the element input is required
	 * @var boolean
	 */
	public $required = false;
	
	/**
	 * Is the element read only ?
	 * @var boolean
	 */
	public $readOnly = false;
	
	/**
	 * Validations
	 * @var mixed
	 */
	public $validations = array();
	
	/**
	 * Class
	 * @var string
	 */
	public $class = '';

	/**
	 * The form that own this element
	 * @var Form
	 */
	protected $form = null;

	/**
	 * Value of the element
	 * @var mixed
	 */
	public $value = null;
	
	/**
	 * Errors found during validation
	 * @var string[]
	 */
	public $errors = array();
	
	/**
	 * Constructor
	 * @param mixed $params
	 */
	public function __construct($params = array())
	{
		$this->id = isset($params['id']) ? $params['id'] : '';
		$this->label = isset($params['label']) ? $params['label'] : '';
		$this->required = isset($params['required']) ? $params['required'] : false;
		$this->readOnly = isset($params['readOnly']) ? $params['readOnly'] : false;
		$this->validations = isset($params['validations']) ? $params['validations'] : array();
		$this->class = isset($params['class']) ? $params['class'] : '';
		$this->value = isset($params['value']) ? $params['value'] : null;
		$this->setForm(isset($params['form']) ? $params['form'] : null);
	}
	
	/**
	 * Set form
	 * @param Form $form
	 */
	public function setForm($form = null)
	{
		$this->form = $form;
		if(isset($this->form))
		{
			if($this->form->hasPostData())
			{
				$this->loadValue();
				$this->validate();
			}
		}		
	}
	
	/**
	 * Get form
	 * @return Form
	 */
	public function getForm()
	{
		return $this->form;
	}
	
	/**
	 * Load value from post data
	 * @return void
	 */
	public function loadValue()
	{
		$this->value = null;
		if(isset($this->form->data[$this->id]))
		{
			$this->value = $this->form->data[$this->id];
		}
	}
	
	/**
	 * Validate the value of the element and fill errors
	 * return boolean
	 */
	private function validate()
	{
		$this->errors = array();		
		
		if($this->required && $this->value == '')
		{
			$this->errors[] = 'Champ obligatoire';
		}
		
		foreach($this->validations as $v)
		{
			switch($v['type'])
			{
				case FORMELEMENT_VALIDATION_REGEX:
					if(isset($v['pattern']))
					{
						if(preg_match($v['pattern'], $this->value) === 0)
						{
							$this->errors[] = $v['message'];
						}
					}
					break;
				case FORMELEMENT_VALIDATION_INT:
					if(is_int($this->value) === false)
					{
						$this->errors[] = $v['message'];
					}
					break;
				case FORMELEMENT_VALIDATION_FLOAT:
					if(is_numeric($this->value) === false)
					{
						$this->errors[] = $v['message'];
					}
					break;
				case FORMELEMENT_VALIDATION_DATETIME:
				case FORMELEMENT_VALIDATION_DATE:
				case FORMELEMENT_VALIDATION_TIME:
					if(isset($v['format']))
					{
						$d = \DateTime::createFromFormat($v['format'], $this->value);
						if($d === false || $d->format($v['format']) != $this->value)
						{
							$this->errors[] = $v['message'];
						}
					}
					break;
				case FORMELEMENT_VALIDATION_EMAIL:
					if(filter_var($this->value, FILTER_VALIDATE_EMAIL) === false)
					{
						$this->errors[] = $v['message'];
					}
					break;
			}
		}

		return count($this->errors) == 0;
	}
	
	/**
	 * Get the HTML code of the element
	 * @return string 
	 */
	public abstract function getHtml();
	
	/**
	 * Get error html code
	 * @return string
	 */
	public function getErrorHtml()
	{
		$html = '';
		if(count($this->errors) > 0)
		{
			$html .= '<div class="col-sm-offset-2" class="help-block">';
			foreach($this->errors as $v)
			{
				$html .= '<span class="help-block">'.$v.'</span>';
			}
			$html .= '</div>';
		}
		return $html;
	}
 
	/**
	 * Render the element
	 */
	public function render()
	{
		echo $this->getHtml();
	}
	
	/**
	 * Has error?
	 * return bool
	 */
	public function hasError()
	{
		return count($this->errors) > 0;
	}
}
