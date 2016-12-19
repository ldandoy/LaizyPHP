<?php
/**
 * File system\Form.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */

namespace system;

/**
 * Class gérant les Forms du site
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */
class Form
{
    public $controller;

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function input($config = array())
    {
        $label = $config['label'];
        if (!isset($config['placeholder'])) {
            $placeholder = $label;
        } else {
            $placeholder = $config['placeholder'];
        }
        if (!isset($config['id'])) {
            $id = 'input'.ucfirst($label);
        } else {
            $id = $config['id'];
        }

        echo '<div class="form-group">';
        $this->label(array(
            'label' => $label,
            'id'    => $id
        ));
        echo '<input name="'.$label.'" type="text" value="'.$config['value'].'" class="form-control" id="'.$id.'" placeholder="Entrez votre '.$placeholder.'">';
        echo '</div>';
    }

    public function label($config = array())
    {
        $label = $config['label'];
        if (!isset($config['id'])) {
            $id = 'input'.ucfirst($label);
        } else {
            $id = $config['id'];
        }

        echo '<label for="'.$id.'">'.ucfirst($label).' :</label>';
    }

    public function textarea($config = array())
    {
        $label = $config['label'];
        if (!isset($config['placeholder'])) {
            $placeholder = $label;
        } else {
            $placeholder = $config['placeholder'];
        }
        if (!isset($config['id'])) {
            $id = 'input'.ucfirst($label);
        } else {
            $id = $config['id'];
        }

        echo '<div class="form-group">';
        $this->label(array(
            'label' => $label,
            'id'    => $id
        ));
        echo '<textarea name="'.$label.'" id="'.$id.'" placeholder="Entrez votre '.$placeholder.'" class="form-control" rows="3">'.$config['value'].'</textarea>';
        echo '</div>';
    }

    /**
     * array(
     *  'type'
     *  'label' =>
     *  'value' =>
     *  'color' =>
     *  'align' =>
     * )
     */
    public function btn($config = array())
    {
        $label = $config['label'];
        if (!isset($config['placeholder'])) {
            $placeholder = $label;
        } else {
            $placeholder = $config['placeholder'];
        }
        if (!isset($config['id'])) {
            $id = 'input'.ucfirst($label);
        } else {
            $id = $config['id'];
        }
        if (!isset($config['align'])) {
            $align = 'left';
        } else {
            $align = $config['align'];
        }
        if (!isset($config['color'])) {
            $color = 'default';
        } else {
            $color = $config['color'];
        }
        if (!isset($config['type'])) {
            $type = 'submit';
        } else {
            $type = $config['type'];
        }

        echo '<div class="form-group">';
        echo '<button type="'.$type.'" name="'.$label.'" class="btn btn-'.$color.' pull-'.$align.'">'.$config['value'].'</button>';
        echo '<div class="clearfix"></div>';
        echo '</div>';
    }
}
