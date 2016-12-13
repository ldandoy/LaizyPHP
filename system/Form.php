<?php

namespace system;

class Form
{
    public $controller;

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function input($name, $placeholder=null, $id=null)
    {
        $label = $name;
        if ($placeholder == null) {
            $placeholder = $name;
        }
        if ($id == null) {
            $id = 'input'.ucfirst($name);
        }

        echo '<div class="form-group">';
        $this->label($label, $id);
        echo '<input name="'.$name.'" type="text" class="form-control" id="'.$id.'" placeholder="Entrez votre '.$placeholder.'">';
        echo '</div>';
    }

    public function label($label, $id=null)
    {
        if ($id !== null) {
            $id = 'input'.ucfirst($label);
        }

        echo '<label for="'.$id.'">'.ucfirst($label).' :</label>';
    }

    public function textarea($name, $placeholder=null, $id=null)
    {
        $label = $name;
        if ($placeholder == null) {
            $placeholder = $name;
        }
        if ($id == null) {
            $id = 'input'.ucfirst($name);
        }
        echo '<div class="form-group">';
        $this->label($label, $id);
        echo '<textarea name="'.$name.'" id="" placeholder="Entrez votre '.$placeholder.'" class="form-control" rows="3"></textarea>';
        echo '</div>';
    }

    public function submit($name, $value, $color='default', $align='left')
    {
        echo '<div class="form-group">';
        echo '<button type="submit" name="'.$name.'" class="btn btn-'.$color.' pull-'.$align.'">'.$value.'</button>';
        echo '<div class="clearfix"></div>';
        echo '</div>';
    }
}
