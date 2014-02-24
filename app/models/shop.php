<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/4/13
 * Time: 4:34 PM
 * To change this template use File | Settings | File Templates.
 */

class Shop extends AppModel
{
    private $quantity;

    public static function get($item_id, Character $character)
    {
        $db = DB::conn();

        $row = $db->row('SELECT * FROM item WHERE item_id = ?', array($item_id));

        if (!$row) {
            throw new RecordNotFoundException('Record not found');
        }

        $row['character'] = $character;
        return new self($row);
    }

    public function buyItem()
    {
        $params = array(
            'char_id' => $this->character->char_id,
            'item_id' => $this->item_id,
            'item_type' => Item::ITEM_TYPE_USEABLE
        );

        try {
            $item = $this->character->getServiceLocator()->getItemService()->getFromInventory(
                Item::ITEM_TYPE_USEABLE,
                $this->item_id
            );
            $item->update($this->getQuantity(), $params);
        } catch(RecordNotFoundException $e) {
            Item::create($this->item_id, Item::ITEM_TYPE_USEABLE, $this->character->char_id, $this->getQuantity());
        }
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function sellItem()
    {
        // TODO : write sell function
    }
}