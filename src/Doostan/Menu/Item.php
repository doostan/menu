<?php
namespace Doostan\Menu;

class Item implements \Iterator, \Countable
{
    protected $id;
    
    protected $title;
    
    protected $parent;
    
    protected $children;
    
    private $iteratorPos=0;
    
    public function __construct($title)
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