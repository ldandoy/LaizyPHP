<?php

namespace system\Form;

use system\form\FormElement;
use system\Bootstrap;

/**
 * Class Form
 */
class Form
{
	/**
	 * The forms's id / name
	 * @var string
	 */
	public $id = '';
	
	/**
	 * The form's action
	 * @var string
	 */
	public $action = '';
	
	/**
	 * The form's submit control id
	 * @var string
	 */
	public $submit = 'submit';
	
	/**
	 * Array of FormElement
	 * @var FormElement[]
	 */
	public $elements = array();
	
	/**
	 * Is the form read only ?
	 * @var bool
	 */
	public $readOnly = false;
	
	/**
	 * Post data
	 * @var mixed
	 */
	public $data = array();

	/**
	 * Constructor
	 * @param mixed $params
	 */
	public function __construct($params = array())
	{
		$this->id = isset($params['id']) ? $params['id'] : '';
		$this->action = isset($params['action']) ? $params['action'] : '';
		$this->submit = isset($params['submit']) ? $params['submit'] : 'submit';
		$this->readOnly = isset($params['readOnly']) ? $params['readOnly'] : false;
		$this->loadData();
	}

	/**
	 * Create from Model
	 *
	 * @param system\Model $model
	 * @param string $action
	 *
	 * @return system\form\Form
	 */
	public static function createFromModel($model, $action)
	{
		$class = getLastElement(explode('\\', get_class($model)));

		$form = new Form(array(
			'id' => 'form',
			'action' => $action,
			'submit' => 'submit'
		));

		return $form;
	}
	
	/**
	 * Load data from post data
	 */
	public function loadData()
	{
		$this->data = array();
		if(isset($_POST['formid']) && $_POST['formid'] == $this->id)
		{
			foreach($_POST as $k => $v)
			{
				$this->data[$k] = $v;
			}
		}
	}

	/**
	 * Load data from post data
	 * @param mixed $data
	 */
	public function setData($data)	{
		
		$this->data = $data;
		foreach($this->elements as $e)
		{
			$e->loadValue();
		}
	}
	
	/**
	 * Add a FormElement
	 * @param FormElement $element
	 */
	public function addElement($element)
	{
		$element->setForm($this);
		$this->elements[] = $element;
	}

	/**
	 * Get an element by index or id
	 * @param mixed
	 * @return FormElement
	 */
	public function getElement($index)
	{
		switch(gettype($index))
		{
			case 'int':
				return $this->elements[$index];
			case 'string':
				foreach($this->elements as $e)
				{
					if($e->id == $index || $e->id == $this->id.'_'.$index)
					{
						return $e;
					}
				}
			default:
				return null;
		}
	}	
	
	/**
	 * Get the HTML code of the form
	 * @return string 
	 */
	public function getHtml()
	{
		$error = '';
		if($this->isValid() === false)
		{
			$error = "\t".Bootstrap::alert('<strong>Il y a des erreurs dans le formulaire.</strong>', BOOTSTRAP_ALERT_DANGER, false).CRLF;
		}
		
		$enctype = '';
		$elements = "\t".'<input id="formid" name="formid" type="hidden" value="'.$this->id.'" />'.CRLF;
		foreach($this->elements as $e)
		{
			$elements .= "\t".$e->getHtml().CRLF;
		}
		
		return 
			'<form id="'.$this->id.'" action="'.$this->action.'"'.$enctype.' method="post" class="form-horizontal">'.CRLF.
			$error.
			$elements.
			'</form>'.CRLF;
	}

	/**
	 * Render the form
	 */
	public function render()
	{
		echo $this->getHtml();
	}

	/**
	 * True if the form has post data
	 * return boolean
	 */
	public function hasPostData()
	{
		return count($this->data) > 0;
	}	

	/**
	 * True if the form has post data
	 * return boolean
	 */
	public function isSubmit()
	{
		return $this->hasPostData() && isset($this->data[$this->submit]) > 0;
	}	
	
	/**
	 * Is the form valid ?
	 * return boolean
	 */
	public function isValid()
	{
		$valid = true;
		foreach($this->elements as $e)
		{
			$valid = $valid && count($e->errors) == 0;
		}
		return $valid;
	}	
}
