<?php

namespace Expres\DemoAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * pfpProject
 */
class pfpProject
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $shortDescribtion;

    /**
     * @var string
     */
    private $describtion;


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
     * Set created
     *
     * @param \DateTime $created
     * @return pfpProject
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return pfpProject
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set shortDescribtion
     *
     * @param string $shortDescribtion
     * @return pfpProject
     */
    public function setShortDescribtion($shortDescribtion)
    {
        $this->shortDescribtion = $shortDescribtion;

        return $this;
    }

    /**
     * Get shortDescribtion
     *
     * @return string 
     */
    public function getShortDescribtion()
    {
        return $this->shortDescribtion;
    }

    /**
     * Set describtion
     *
     * @param string $describtion
     * @return pfpProject
     */
    public function setDescribtion($describtion)
    {
        $this->describtion = $describtion;

        return $this;
    }

    /**
     * Get describtion
     *
     * @return string 
     */
    public function getDescribtion()
    {
        return $this->describtion;
    }
}
