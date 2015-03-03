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

interface MakerInterface
{
    public function make(\Doostan\Menu\Item $item);
}