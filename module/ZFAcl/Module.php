<?php

namespace ZFAcl;

use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;

class Module
{
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
   
    
    public function getServiceConfig()
    {
        
        return array(
          'factories' => array(
              'ZFAcl\Form\Role' => function($sm)
              {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $repo = $em->getRepository('ZFAcl\Entity\Role');
                $parent = $repo->fetchParent();
                
                return new Form\Role('role',$parent);
              },
              'ZFAcl\Form\Privilege' => function($sm)
              {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $repoRoles = $em->getRepository('ZFAcl\Entity\Role');
                $roles = $repoRoles->fetchParent();
                
                $repoResources = $em->getRepository('ZFAcl\Entity\Resource');
                $resources = $repoResources->fetchPairs();
                
                return new Form\Privilege("privilege", $roles, $resources);
              },
              
              'ZFAcl\Service\Role' => function($sm){
                return new Service\Role($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'ZFAcl\Service\Resource' => function($sm){
                return new Service\Resource($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'ZFAcl\Service\Privilege' => function($sm){
                return new Service\Privilege($sm->get('Doctrine\ORM\Entitymanager'));
              },
              
              'ZFAcl\Permissions\Acl' => function($sm)
              {
                  $em = $sm->get('Doctrine\ORM\EntityManager');
                  
                  $repoRole = $em->getRepository("ZFAcl\Entity\Role");
                  $roles = $repoRole->findAll();
                  
                  $repoResource = $em->getRepository("ZFAcl\Entity\Resource");
                  $resources = $repoResource->findAll();
                  
                  $repoPrivilege = $em->getRepository("ZFAcl\Entity\Privilege");
                  $privileges = $repoPrivilege->findAll();
                  
                  return new Permissions\Acl($roles,$resources,$privileges);
              }
          )  
        );
        
    }

}
