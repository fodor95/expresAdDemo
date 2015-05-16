<?php

namespace Expres\DemoAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * BlogPosts
 */
class BlogPosts
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     */
    private $category;

    /**
     * @var string
     */
    private $tags;


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
     * Set title
     *
     * @param string $title
     * @return BlogPosts
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
     * Set content
     *
     * @param string $content
     * @return BlogPosts
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return BlogPosts
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

 

    /**
     * Set tags
     *
     * @param string $tags
     * @return BlogPosts
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @var \Expres\DemoAdminBundle\Entity\BlogCategories
     */
    private $address;




    /**
     * @var \Expres\DemoAdminBundle\Entity\BlogCategories
     */
    private $blogcategories;


    /**
     * Set category
     *
     * @param integer $category
     * @return BlogPosts
     */
    public function setCategory($category = 1)
    {
        $this->category = 1;

        return $this;
    }

    /**
     * Get category
     *
     * @return integer 
     */
    public function getCategory()
    {
        return $this->category;
    }



    /**
     * Set blogcategories
     *
     * @param \Expres\DemoAdminBundle\Entity\BlogCategories $blogcategories
     * @return BlogPosts
     */
    public function setBlogcategories(\Expres\DemoAdminBundle\Entity\BlogCategories $blogcategories = null)
    {
        $this->blogcategories = $blogcategories;

        return $this;
    }

    /**
     * Get blogcategories
     *
     * @return \Expres\DemoAdminBundle\Entity\BlogCategories 
     */
    public function getBlogcategories()
    {
        return $this->blogcategories;
    }
}
