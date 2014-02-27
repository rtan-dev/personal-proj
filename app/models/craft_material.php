<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/15/14
 * Time: 6:55 PM
 */
class CraftMaterial extends Item
{
    public static function getMaterials(Character $character, $item_name)
    {
        $db = DB::conn();

        $row = $db->row(
            'SELECT a.item_name, a.item_id, b.quantity FROM item a INNER JOIN inventory b ON  a.item_id = b.item_id
            WHERE a.item_name = ? AND b.item_type = ? AND b.char_id = ?',
            array($item_name, self::ITEM_TYPE_LOOT, $character->getID())
        );

        return $row ? new self($row) : 0;
    }

    public function getInInventory()
    {
        return $this->in_inventory;
    }

    public function validate()
    {
        if ($this->getInInventory() < $this->getQuantity()) {
            throw new NotEnoughMaterialsException('Not enough materials');
        }
    }
}