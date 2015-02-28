<?php
namespace Doostan\Menu\Maker;

class NestedUlsMaker implements MakerInterface
{
    private $menu;
    
    public function __construct()
    {
        $this->menu = '<ul>';
    }
    
    public function make(\Doostan\Menu\Item $item)
    {
        
        $this->menu .= '<li ';
        $props = '';
        foreach($item->getProperties() as $key => $val) {
            $props .= $key.'="'.$val.' "';
        }
        $this->menu .= $props. '>'.$item->getTitle();
        
        if(!empty($item->getChildren())) {
            $this->menu .= '<ul >';
            foreach($item as $child) {
                
                $this->make($child);
                
            }
            $this->menu .= '</ul>';
        }
        $this->menu .= '</li>';
        
        
        return $this->menu.'</ul>';
    }
}