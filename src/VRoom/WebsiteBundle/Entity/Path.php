<?php

namespace VRoom\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Path
 *
 * @ORM\Table("paths")
 * @ORM\Entity
 */
class Path
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="start_city", referencedColumnName="id")
     */
    private $startCity;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="end_city", referencedColumnName="id")
     */
    private $endCity;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set startCity
     *
     * @param integer $startCity
     * @return Path
     */
    public function setStartCity($startCity)
    {
        $this->startCity = $startCity;

        return $this;
    }

    /**
     * Get startCity
     *
     * @return integer 
     */
    public function getStartCity()
    {
        return $this->startCity;
    }

    /**
     * Set endCity
     *
     * @param integer $endCity
     * @return Path
     */
    public function setEndCity($endCity)
    {
        $this->endCity = $endCity;

        return $this;
    }

    /**
     * Get endCity
     *
     * @return integer 
     */
    public function getEndCity()
    {
        return $this->endCity;
    }
}
