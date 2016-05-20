<?php

namespace ZFAcl\Controller;

use ZFBase\Controller\CrudController;
use Zend\View\Model\ViewModel;

class ResourcesController extends CrudController
{

    public function __construct() {
        $this->entity = "ZFAcl\Entity\Resource";
        $this->service = "ZFAcl\Service\Resource";
        $this->form = "ZFAcl\Form\Resource";
        $this->controller = "resources";
        $this->route = "zfacl-admin/default";
    }
}
