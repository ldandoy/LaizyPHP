<?php
/**
 * File system\Request.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */

namespace system;

/**
 * Class manage request
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */
class Request
{
    /**
     * @var string
     */
    public $url;

    public $params;

    /**
     * @var mixed
     */
    public $post = null;

    /**
     * @var string get|post
     */
    public $method = 'get';

    /**
     * @var string html|json
     */
    public $format = 'html';

    /**
     * Constructor
     *
     * Getting the url to create an array with prefix, controller, action, params, method infos
     *
     * @return void
     */
    public function __construct()
    {
        /* We manage the request info */
        if (isset($_SERVER['PATH_INFO'])) {
            $this->url = $_SERVER['PATH_INFO'];
            $prefix = '/'.ltrim(Config::getValueG('admin_prefix'), '/');
            $nbUrlElements = count(deleteEmptyItem(explode('/', $this->url)));
            
            /* if the url begin this admin_prefix */
            if (strpos($this->url, $prefix) === 0) {
                if ($nbUrlElements <= 1) {
                    $this->url = rtrim($this->url, '/').'/'.Config::getValueG('controller');
                }

                if ($nbUrlElements <= 2) {
                    $this->url = rtrim($this->url, '/').'/'.Config::getValueG('action');
                }
            } else {
                if ($nbUrlElements <= 1) {
                    $this->url = rtrim($this->url, '/').'/'.Config::getValueG('action');
                }
            }
            
            $elements = explode('.', $_SERVER['PATH_INFO']);
            if (count($elements) >= 2) {
                $this->format = getLastElement($elements);
            } else {
                $this->format = 'html';
            }
        } else {
            /* If the url is just / */
            $this->url = '/'.Config::getValueG('controller').'/'.Config::getValueG('action');
            $this->format = 'html';
        }

        /* We manage the request method */
        $this->method = $_SERVER['REQUEST_METHOD'];

        /* We manage the request params */
        if (!empty($_POST)) {
            $this->post = $_POST;
        }
    }
}
