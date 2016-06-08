<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Jms;

/**
 * @ORM\Table("groups")
 * @ORM\Entity
 * @Jms\AccessType("property")
 */
class Group
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    public $name;
}