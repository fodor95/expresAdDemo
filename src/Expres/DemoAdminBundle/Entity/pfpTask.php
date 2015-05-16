<?php

namespace Expres\DemoAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * pfpTask
 */
class pfpTask
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
    private $name;

    /**
     * @var string
     */
    private $shortDescribtion;

    /**
     * @var string
     */
    private $header;

    /**
     * @var integer
     */
    private $progress;

    /**
     * @var integer
     */
    private $projectID;

    /**
     * @var integer
     */
    private $stateID;

    /**
     * @var integer
     */
    private $place;


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
     * @return pfpTask
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
     * Set name
     *
     * @param string $name
     * @return pfpTask
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set shortDescribtion
     *
     * @param string $shortDescribtion
     * @return pfpTask
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
     * Set header
     *
     * @param string $header
     * @return pfpTask
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return string 
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set progress
     *
     * @param integer $progress
     * @return pfpTask
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return integer 
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Set projectID
     *
     * @param integer $projectID
     * @return pfpTask
     */
    public function setProjectID($projectID)
    {
        $this->projectID = $projectID;

        return $this;
    }

    /**
     * Get projectID
     *
     * @return integer 
     */
    public function getProjectID()
    {
        return $this->projectID;
    }

    /**
     * Set stateID
     *
     * @param integer $stateID
     * @return pfpTask
     */
    public function setStateID($stateID)
    {
        $this->stateID = $stateID;

        return $this;
    }

    /**
     * Get stateID
     *
     * @return integer 
     */
    public function getStateID()
    {
        return $this->stateID;
    }

    /**
     * Set place
     *
     * @param integer $place
     * @return pfpTask
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return integer 
     */
    public function getPlace()
    {
        return $this->place;
    }
}
