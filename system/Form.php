<?php

	namespace system;
	
	class Form {

		public $controller;

		function __construct($controller) {
			$this->controller = $controller;
		}

		function input($name, $placeholder=null, $id=null) {
			$label = $name;
			if ($placeholder == NULL) {
				$placeholder = $name;
			}
			if ($id == NULL) {
				$id = 'input'.ucfirst($name);
			}

			echo '<div class="form-group">';
				$this->label($label, $id);
				echo '<input name="'.$name.'" type="text" class="form-control" id="'.$id.'" placeholder="Entrez votre '.$placeholder.'">';
			echo '</div>';
		}

		function label ($label, $id=null) {
			if ($id !== null) {
				$id = 'input'.ucfirst($label);
			}

			echo '<label for="'.$id.'">'.ucfirst($label).' :</label>';
		}

		function textarea ($name, $placeholder=null, $id=null) {
			$label = $name;
			if ($placeholder == NULL) {
				$placeholder = $name;
			}
			if ($id == NULL) {
				$id = 'input'.ucfirst($name);
			}
			echo '<div class="form-group">';
			$this->label($label, $id);
			echo '<textarea name="" id="" placeholder="Entrez votre '.$placeholder.'" class="form-control" rows="3"></textarea>';
			echo '</div>';
		}

		function submit($name, $value, $color='default', $align='left') {
			echo '<div class="form-group">';
				echo '<button type="submit" name="'.$name.'" class="btn btn-'.$color.' pull-'.$align.'">'.$value.'</button>';
				echo '<div class="clearfix"></div>';
			echo '</div>';
		}
	}