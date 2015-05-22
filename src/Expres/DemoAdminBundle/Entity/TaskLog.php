<?php

namespace Expres\DemoAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaskLog
 */
class TaskLog
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $taskId;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var integer
     */
    private $stage;


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
     * Set taskId
     *
     * @param integer $taskId
     * @return TaskLog
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;

        return $this;
    }

    /**
     * Get taskId
     *
     * @return integer 
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return TaskLog
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
     * Set stage
     *
     * @param integer $stage
     * @return TaskLog
     */
    public function setStage($stage)
    {
        $this->stage = $stage;

        return $this;
    }

    /**
     * Get stage
     *
     * @return integer 
     */
    public function getStage()
    {
        return $this->stage;
    }
}
