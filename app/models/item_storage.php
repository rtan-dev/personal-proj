<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 5/31/14
 * Time: 8:09 PM
 */
class ItemStorage
{
    private $character;
    protected $potions = null;
    protected $loots = null;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function getPotions()
    {
        if ($this->potions) {
            return $this->potions;
        }

        $db = DB::conn();
        $rows = $db->rows('SELECT * FROM inventory WHERE char_id = ? AND item_type = ?', array($this->character->char_id, Item::ITEM_TYPE_USEABLE));

        $this->potions = array();
        foreach ($rows as $row) {
            $row['character'] = $this->character;
            $this->potions[] = new Potion($row);
        }
        return $this->potions;
    }

    public function getLoots()
    {
        if ($this->loots) {
            return $this->loots;
        }

        $db = DB::conn();
        $rows = $db->rows('SELECT * FROM inventory WHERE char_id = ? AND item_type = ?', array($this->character->char_id, Item::ITEM_TYPE_LOOT));

        $this->loots = array();
        foreach ($rows as $row) {
            $row['character'] = $this->character;
            $this->loots[] = new Loot($row);
        }
        return $this->loots;
    }
}