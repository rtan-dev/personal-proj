<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/4/13
 * Time: 4:49 PM
 * To change this template use File | Settings | File Templates.
 */

class Item extends AppModel
{
    const ITEM_TYPE_USEABLE = 'useable';
    const ITEM_TYPE_LOOT = 'loot';
    const DEFAULT_QUANTITY = 1;
    const SET_HERB = 1;
    const HERB_COUNT = 5;
    const MAX_LOOT_COUNT = 4;
    public $char_id;
    public $item_name;
    public $type;

    /**
     * Creates an item to
     * character inventory.
     * @param $item_id
     * @param $item_type
     * @param $char_id
     * @param $quantity
     */
    public static function create($item_id, $item_type, $char_id, $quantity)
    {
        $db = DB::conn();
        $params = array(
            'char_id' => $char_id,
            'item_id' => $item_id,
            'item_type' => $item_type,
            'quantity' => $quantity,
        );

        $db->insert('inventory', $params);
    }

    public function delete()
    {
        $db = DB::conn();

        $db->query('DELETE FROM inventory WHERE char_id = ? AND item_id = ? AND item_type = ?',
            array($this->character->char_id, $this->item_id, $this->item_type)
        );
    }

    public function get($item_id)
    {
        $db = DB::conn();

        $row = $db->row('SELECT * from item WHERE item_id = ?', array($item_id));

        if (!$row) {
            throw new RecordNotFoundException('Record not found.');
        }

        $this->set($row);
        return $this;
    }

    public function getID()
    {
        return $this->item_id;
    }

    public function getName()
    {
        return $this->item_name;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getType()
    {
        return $this->item_type;
    }

    /**
     * Retrieves all useable items from the database.
     * @return array
     */
    public static function getUseableItems()
    {
        $db = DB::conn();

        $rows = $db->rows('SELECT * FROM item WHERE item_type=?', array(self::ITEM_TYPE_USEABLE));

        $items = array();

        if ($rows) {
            foreach ($rows as $row) {
                $items[] = new Item($row);
            }
        }

        return $items;
    }

    public static function getFromInventory($type, $item_id, Character $character)
    {
        $db = DB::conn();

        $row = $db->row(
            'SELECT * FROM inventory WHERE item_type = ? AND char_id = ? AND item_id = ?',
            array($type, $character->char_id, $item_id)
        );

        if (!$row) {
            throw new RecordNotFoundException('Record not found in the database.');
        }

        $row['character'] = $character;
        return new self($row);
    }

    public function decr($in_inventory, $dec_count)
    {
        $db = DB::conn();

        $quantity = $in_inventory - $dec_count;
        if ($quantity <= 0) {
            $this->delete();
            return;
        }

        $where_params = array(
            'item_id' => $this->getID(),
            'char_id' => $this->character->getID(),
            'item_type' => $this->getType()
        );

        $db->update('inventory', array('quantity' => $quantity), $where_params);
    }

    public function incr()
    {
        $db = DB::conn();

        $params = array(
            'quantity' => $this->getQuantity() + 1 // increment current quantity of item
        );

        $where_params = array(
            'item_id' => $this->getID(),
            'char_id' => $this->character->getID(),
            'item_type' => $this->getType()
        );

        $db->update('inventory', $params, $where_params);
    }

    public function update($quantity, $params = array())
    {
        $db = DB::conn();
        $db->update('inventory', array('quantity' => $quantity), $params);
    }
}