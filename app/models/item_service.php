<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/8/14
 * Time: 7:30 PM
 */

class ItemService
{
    private $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function getPotions()
    {
        return Potion::getPotions($this->character->char_id);
    }

    public function getFromInventory($type, $item_id)
    {
        return Item::getFromInventory($type, $item_id, $this->character);
    }

    public function getLoots($monster_id)
    {
        return Loot::getLoots($monster_id)->randomizeLoots();
    }
}