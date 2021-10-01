<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class ItemSearch
{


    /**
     * @var ArrayCollection;
     */
    private $category;

    /**
     * @var ArrayCollection
     */
    private $tag;


    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->tag = new ArrayCollection();
    }
    
    /**
     * Get the value of category
     *
     * @return  ArrayCollection
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @param  ArrayCollection  $category
     *
     * @return  self
     */ 
    public function setCategory(ArrayCollection $category)
    {
        $this->category = $category;

        return $this;
    }


        /**
     * Get the value of tag
     *
     * @return  ArrayCollection
     */ 
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set the value of tag
     *
     * @param  ArrayCollection  $tag
     *
     * @return  self
     */ 
    public function setTag(ArrayCollection $tag)
    {
        $this->tag = $tag;

        return $this;
    }
}
