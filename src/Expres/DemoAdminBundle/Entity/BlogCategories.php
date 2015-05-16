<?php

namespace Expres\DemoAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * BlogCategories
 */
class BlogCategories
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    private $posts;


    public function __construct(){
        $this->page = new ArrayCollection();
    }

    public function __toString(){
        return $this->name;
    }

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
     * Set name
     *
     * @param string $name
     * @return BlogCategories
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
     * Add posts
     *
     * @param \Expres\DemoAdminBundle\Entity\BlogPosts $posts
     * @return BlogCategories
     */
    public function addPost(\Expres\DemoAdminBundle\Entity\BlogPosts $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \Expres\DemoAdminBundle\Entity\BlogPosts $posts
     */
    public function removePost(\Expres\DemoAdminBundle\Entity\BlogPosts $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
