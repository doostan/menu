<?php
namespace Doostan\Menu\Maker;

class NestedUlsMaker implements MakerInterface
{
    private $menu='';
    
    public function make(\Doostan\Menu\Item $item)
    {
        $parentUl=false; // parent ul element required?
        if($item->getParent() === null) {
            if($item->getTitle() != '') {
                $parentUl=true; // parent ul element is required
                $this->menu .= '<ul>';
                $this->menu .= '<li ';
                $props = '';
                foreach($item->getProperties() as $key => $val) {
                    $props .= $key.'="'.$val.' "';
                }
                $this->menu .= $props. '>'.$item->getTitle();
            }
        } else {
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
        
        if($parentUl) {
            $this->menu .= '</li></ul>';
        } else {
            $this->menu .= '</li>';
        }
        return $this->menu;
    }
}