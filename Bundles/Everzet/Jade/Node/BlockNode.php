<?php

namespace Everzet\Jade;

/*
 * This file is part of the Jade.php.
 * (c) 2010 Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Block Node. 
 */
class Node_BlockNode extends Node_Node
{
    protected $childs = array();

    /**
     * Add child node. 
     * 
     * @param   Node    $node   child node
     */
    public function addChild(Node_Node $node)
    {
        $this->childs[] = $node;
    }

    /**
     * Return child nodes. 
     * 
     * @return  array           array of Node's
     */
    public function getChilds()
    {
        return $this->childs;
    }
}
