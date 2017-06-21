<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="tasks")
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDone = false;

    /**
    * @ORM\ManyToOne(targetEntity="User", inversedBy="tasks")
    * @var User
    */
    private $user;

    public function __construct($name, $description)
    {
        $this->name         = $name;
        $this->description  = $description;
    }

    public function setName($name)
    {
        return $this->name = $name;
    }

    public function setDescription($description)
    {
        return $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function isDone()
    {
        return $this->isDone;
    }

    public function toggleStatus()
    {
        $this->isDone = $this->isDone ?  FALSE : TRUE;
    }

    /**
    * @return User
    */
    public function getUser()
    {
        return $this->user;
    }

    /**
    * @param User $user
    */
    public function setUser(User $user)
    {
        $this->user = $user;
    }
}