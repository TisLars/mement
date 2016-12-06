<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Triangle
 *
 * @ORM\Table(name="triangle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TriangleRepository")
 */
class Triangle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2,)
     * @Assert\NotBlank()
     */
    private $a;

    /**
     * @ORM\Column(type="string", length=2,)
     * @Assert\NotBlank()
     */
    private $b;

    /**
     * @ORM\Column(type="integer", length=2,)
     * @Assert\NotBlank()
     */
    private $c;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getA()
    {
        return $this->a;
    }

    public function setA($a)
    {
        $this->a = $a;
    }

    public function getB()
    {
        return $this->b;
    }

    public function setB($b)
    {
        $this->b = $b;
    }

    public function getC()
    {
        return $this->c;
    }

    public function setC($c)
    {
        $this->c = $c;
    }
}

