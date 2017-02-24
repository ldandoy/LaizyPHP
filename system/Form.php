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

        $p['name'] = isset($params['name']) ? $params['name'] : '';
        $p['id'] = $p['name'];

        $p['label'] = isset($params['label']) ? $params['label'] : '';

        $class = isset($params['class']) ? $params['class'] : '';
        $p['class'] = rtrim(' '.$class);

        $p['value'] = isset($params['value']) ? $params['value'] : '';

        $p['placeholder'] = isset($params['placeholder']) ? $params['placeholder'] : '';

        $readOnly = isset($params['readOnly']) ? (bool)$params['readOnly'] : false;
        if ($readOnly) {
            $p['readOnly'] = ' readonly="readonly"';
        } else {
            $p['readOnly'] = '';
        }        

        $error = isset($params['error']) ? $params['error'] : '';
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
                    '<input type="text" id="'.$params['id'].'" name="'.$params['name'].'" value="'.$params['value'].'"'.$params['readOnly'].' class="form-control'.$params['class'].'" placeholder="'.$params['placeholder'].'" />'.
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
                    '<input type="password" id="'.$params['id'].'" name="'.$params['name'].'" value="'.$params['value'].'"'.$params['readOnly'].' class="form-control'.$params['class'].'" placeholder="'.$params['placeholder'].'" />'.
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
                    '<textarea id="'.$params['id'].'" name="'.$params['name'].'"'.$params['readOnly'].' cols="'.$cols.'" rows="'.$rows.'" class="form-control'.$params['class'].'" placeholder="'.$params['placeholder'].'">'.$params['value'].'</textarea>'.
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
