<?php

namespace Oneup\AclBundle\Tests\Annotation;

use Doctrine\Common\Annotations\SimpleAnnotationReader;
use Oneup\AclBundle\Annotation as Acl;

class DomainObjectTest extends \PHPUnit_Framework_TestCase
{
    public function testRemoveAclProperty()
    {
        $annotation = new Acl\DomainObject();
        $annotation->removeAcl = false;

        $this->assertFalse($annotation->removeAcl);
    }

    public function testIfAnnotationIsLoadable()
    {
        $reader = new SimpleAnnotationReader();
        $reader->addNamespace('Oneup\AclBundle\Annotation');

        $object = new \ReflectionClass('Oneup\AclBundle\Tests\Model\SomeObject');
        $annotations = $reader->getClassAnnotations($object);
        $objectIdentity = $annotations[0];

        $this->assertCount(1, $annotations);
        $this->assertInstanceOf('Oneup\AclBundle\Annotation\DomainObject', $objectIdentity);
        $this->assertTrue($objectIdentity->removeAcl);
    }
}