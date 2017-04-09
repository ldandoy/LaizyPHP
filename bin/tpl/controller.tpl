<?php

namespace {{namespace}};

use {{usedParentControllerClass}};

class {{controllerName}}Controller extends {{parentControllerClass}}
{
    public function indexAction()
    {
        $this->render(
            'index',
            array(
                'pageTitle' => '{{controllerName}}'
            )
        );
    }

    public function newAction()
    {
        $this->render(
            'edit',
            array(
                'pageTitle' => 'New'
            )
        );
    }

    public function editAction()
    {
        $this->render(
            'edit',
            array(
                'pageTitle' => 'Modification'
            )
        );
    }

    public function createAction()
    {
    }

    public function updateAction($id)
    {
    }

    public function deleteAction($id)
    {
    }
}
