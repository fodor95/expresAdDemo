<?php

namespace Expres\DemoAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaskComments
 */
class TaskComments
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
     * @var string
     */
    private $comment;


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
     * @return TaskComments
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
     * @return TaskComments
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
     * Set comment
     *
     * @param string $comment
     * @return TaskComments
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }
}
