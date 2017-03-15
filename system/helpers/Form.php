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

namespace system\helpers;

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
    /**
     * Parse and check common params
     *
     * @param mixed $params
     *
     * @return mixed
     */
    private static function parseParams($params = array())
    {
        $p = array();
        
        $name = isset($params['name']) ? $params['name'] : '';
        $p['name'] = $name;
        $p['id'] = $name;

        $p['label'] = isset($params['label']) ? $params['label'] : '';

        $class = isset($params['class']) ? $params['class'] : '';
        $p['class'] = rtrim(' '.$class);

        if (isset($params['value'])) {
            $p['value'] = $params['value'];
        } else if (isset($params['model']['value'])) {
            $p['value'] = $params['model']['value'];
        } else {
            $p['value'] = '';
        }

        $p['autocomplete'] = isset($params['autocomplete']) ? ' autocomplete="'.$params['autocomplete'].'"' : '';

        $p['placeholder'] = isset($params['placeholder']) ? $params['placeholder'] : '';

        $readOnly = isset($params['readOnly']) ? (bool)$params['readOnly'] : false;
        if ($readOnly) {
            $p['readOnly'] = ' readonly="readonly"';
        } else {
            $p['readOnly'] = '';
        }        

        if (isset($params['error'])) {
            $error = $params['error'];
        } else if (isset($params['model']['error'])) {
            $error = $params['model']['error'];
        } else {
            $error = '';
        }
        if ($error != '') {
            $p['errorClass'] = ' has-error';
            $p['errorHtml'] = '<div class="help-block error-block">'.$error.'</div>';
        } else {
            $p['errorClass'] = '';
            $p['errorHtml'] = '';
        }

        return array_merge($params, $p);
    }

    /**
     * Generate input text
     *
     * @param mixed $params
     *
     * @return string
     */
    public static function text($params = array())
    {
        $params = self::parseParams($params);

        $html = 
            '<div class="form-group form-group-sm'.$params['errorClass'].'">'.
                '<label for="'.$params['id'].'" class="col-sm-2 control-label">'.$params['label'].'</label>'.
                '<div class="col-sm-10">'.
                    '<input type="text" id="'.$params['id'].'" name="'.$params['name'].'" value="'.$params['value'].'" class="form-control'.$params['class'].'" placeholder="'.$params['placeholder'].'"'.$params['readOnly'].$params['autocomplete'].' />'.
                    $params['errorHtml'].
                '</div>'.
            '</div>';

        return $html;
    }

    /**
     * Generate input password
     *
     * @param mixed $params
     *
     * @return string
     */
    public static function password($params = array())
    {
        $params = self::parseParams($params);

        $html = 
            '<div class="form-group form-group-sm'.$params['errorClass'].'">'.
                '<label for="'.$params['id'].'" class="col-sm-2 control-label">'.$params['label'].'</label>'.
                '<div class="col-sm-10">'.
                    '<input type="password" id="'.$params['id'].'" name="'.$params['name'].'" value="'.$params['value'].'" class="form-control'.$params['class'].'" placeholder="'.$params['placeholder'].'"'.$params['readOnly'].$params['autocomplete'].' />'.
                    $params['errorHtml'].
                '</div>'.
            '</div>';

        return $html;
    }

    /**
     * Generate textarea
     *
     * @param mixed $params
     *
     * @return string
     */
    public static function textarea($params = array())
    {
        $params = self::parseParams($params);

        $cols = isset($params['cols']) ? $params['cols'] : '';
        $rows = isset($params['rows']) ? $params['rows'] : '5';

        $html = 
            '<div class="form-group form-group-sm'.$params['errorClass'].'">'.
                '<label for="'.$params['id'].'" class="col-sm-2 control-label">'.$params['label'].'</label>'.
                '<div class="col-sm-10">'.
                    '<textarea id="'.$params['id'].'" name="'.$params['name'].'" cols="'.$cols.'" rows="'.$rows.'" class="form-control'.$params['class'].'" placeholder="'.$params['placeholder'].'"'.$params['readOnly'].'>'.$params['value'].'</textarea>'.
                    $params['errorHtml'].
                '</div>'.
            '</div>';

        return $html;
    }

    /**
     * Generate submit button
     *
     * @param mixed $params
     *
     * @return string
     */
    public static function submit($params = array())
    {
        $params = self::parseParams($params);

        if($params['readOnly'] != '')
        {
            $disabled = ' disabled="disabled"';
        }
        else
        {
            $disabled = '';
        }
        
        $formId = isset($params['formId']) ? $params['formId'] : '';
        
        $html = 
            '<div class="form-group form-group-sm pull-right">'.
                '<button id="'.$params['id'].'" name="'.$params['name'].'"'.$disabled.' type="submit" value="'.$params['value'].'" form="'.$formId.'" class="btn'.$params['class'].'">'.$params['label'].'</button>'.
            '</div>'.
            '<div class="clearfix"></div>';

        return $html;
    }
}
