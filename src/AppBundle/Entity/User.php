<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Jms;

/**
 * @ORM\Table("users")
 * @ORM\Entity
 * @Jms\AccessType("property")
 */
class User
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
     * @var int
     * @ORM\Column(name="group_id", type="integer")
     **/
    public $groupId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    public $email;

    /**
     * @var string
     * @ORM\Column(name="last_name", type="string")
     */
    public $lastName;

    /**
     * @var string
     * @ORM\Column(name="first_name", type="string")
     */
    public $firstName;

    /**
     * @var boolean
     * @ORM\Column(name="state", type="boolean")
     */
    public $state;

    /**
     * @var \DateTime
     * @ORM\Column(name="creation_date", type="date")
     */
    public $creationDate;
}