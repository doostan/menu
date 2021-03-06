<?php
/**
 * Doostan\Menu component.
 * 
 * @link        https://github.com/doostan/menu
 * @license     http://opensource.org/licenses/MIT MIT license
 * @copyright   Copyright (c) 2015 https://github.com/doostan
 * @author      doostan doostan.github@gmail.com
 */

namespace Doostan\Menu;

class Item implements \Iterator, \ArrayAccess ,\Countable
{
    protected $id;
    
    protected $title;
    
    protected $link;
    
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
        $this->title = (string)$title;
        return $this;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setLink($link)
    {
        $this->link = (string)$link;
        return $this;
    }
    
    public function getLink()
    {
        return $this->link;
    }
    
    public function setParent(\Doostan\Menu\Item $parent)
    {
        $this->parent = $parent;
        return $this;
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
    
    public function moveTo(Item $newParentItem)
    {
        $currParentItem = $this->getParent();
        if($currParentItem instanceof Item) {
            foreach($currParentItem as $key => $item) {
                if($item == $this) {
                    unset($currParentItem[$key]);
                    break;
                }
            }
            $this->setParent($newParentItem);
            $newParentItem->children[] = $this;
        }
        return $this;
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
    
    public function valid()
    {
        return isset($this->children[$this->iteratorPos]);
    }
    
    public function offsetSet($offset, $value) 
    {
        if (is_null($offset)) {
            $this->children[] = $value;
        } else {
            $this->children[$offset] = $value;
        }
    }

    public function offsetGet($offset) 
    {
        return isset($this->children[$offset]) ? $this->children[$offset] : null;
    }
    
    public function offsetExists($offset) 
    {
        return isset($this->children[$offset]);
    }

    public function offsetUnset($offset) 
    {
        unset($this->children[$offset]);
    }
    
    public function count()
    {
        return count($this->children);
    }
}