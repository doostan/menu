<?php
/**
 * Doostan\Menu component.
 * 
 * @link        https://github.com/doostan/menu
 * @license     http://opensource.org/licenses/MIT MIT license
 * @copyright   Copyright (c) 2015 https://github.com/doostan
 * @author      doostan doostan.github@gmail.com
 */

namespace Doostan\Menu\Maker;

use Doostan\Menu\Item;

class NestedUlsMaker implements MakerInterface
{
    private $menu='';
    
    public function make(Item $item)
    {
        $isParentUl=($item->getParent() === null) ? true : false;
        $parentUlRequired=false; // parent ul element is required?
        
        if($isParentUl) {
            if($item->getTitle() != '') {
                $parentUlRequired=true; // parent ul element is required
                $this->menu .= '<ul>';
            }
        }
        if(!$isParentUl || ($isParentUl && $parentUlRequired) ) {
        $this->menu .= '<li ';
            $props = '';
            foreach($item->getProperties() as $key => $val) {
                $props .= $key.'="'.$val.' "';
            }
            $this->menu .= $props. '>'.$item->getTitle();
        }
        if(!empty($item->getChildren())) {
            $this->menu .= '<ul>';
            foreach($item as $child) {
                $this->make($child);
            }
            $this->menu .= '</ul>';
        }
        
        if($isParentUl && $parentUlRequired) {
            $this->menu .= '</li></ul>';
        } else {
            $this->menu .= '</li>';
        }
        return $this->menu;
    }
}