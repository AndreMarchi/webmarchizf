<?php

namespace ZFAcl\Service;

use ZFBase\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class Resource extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = "ZFAcl\Entity\Resource";
    }
    
    
}
