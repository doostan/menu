<?php
/**
 * Doostan\Menu component.
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 * @copyright Copyright (c) 2015 https://github.com/doostan
 * @author doostan doostan.github@gmail.com
 */
namespace Doostan\Menu;

class Item implements \Iterator, \Countable
{
    protected $id;
    
    protected $title;
    
    protected $parent;
    
    protected $children=array();
    
    protected $properties=array();
    
    private $iteratorPos=0;
    
    public function __construct($title=null)
    {
        $this->setTitle($title);
        $this->setId();
    }
    
    private function setId()
    {
        $this->id = uniqid();
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setParent(\Doostan\Menu\Item $parent)
    {
        $this->parent = $parent;
    }
    
    public function getParent()
    {
        return $this->parent;
    }
    
    public function addProperty($key, $value)
    {
        $this->properties[$key] = $value;
        return $this;
    }
    
    public function getProperty($key)
    {
        if(isset($this->properties[$key])) {
            return $this->properties[$key];
        }
    }
    
    public function getProperties()
    {
        return $this->properties;
    }
    
    public function getChildren()
    {
        return $this->children;
    }
    
    public function addChild($title)
    {
        $child = new Item($title);
        $child->setParent($this);
        $this->children[] = $child;
        return $child;
    }
    
    public function make(Maker\MakerInterface $menuMaker)
    {
        return $menuMaker->make($this);
    }
    
    public function rewind()
    {
        $this->iteratorPos=0;
    }
    
    public function key()
    {
        return $this->iteratorPos;
    }
    
    public function current()
    {
        return $this->children[$this->iteratorPos];
    }
    
    public function next()
    {
        ++$this->iteratorPos;
    }
    
    public function valid(){
        return isset($this->children[$this->iteratorPos]);
    }
    
    public function count()
    {
        return count($this->children);
    }
}