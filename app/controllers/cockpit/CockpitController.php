<?php

namespace app\controllers\cockpit;

use app\controllers\ApplicationController;

class CockpitController extends ApplicationController
{
    /**
     * Auth\models\User
     */
    public $current_user = null;

    public function __construct($request)
    {
        parent::__construct($request);

        // Check if an administrator is connected
        $this->current_user = $this->session->get('current_user');
        if ($this->current_user === null) {
            $this->redirect('usersauth_login');
        } else {
            if ($this->current_user->group->cockpit == 0) {
                $this->redirect('');
            }
        }
    }
}
