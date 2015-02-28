<?php
namespace Doostan\Menu\Maker;

interface MakerInterface
{
    public function make(\Doostan\Menu\Item $item);
}