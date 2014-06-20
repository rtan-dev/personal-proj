<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/2/13
 * Time: 3:54 PM
 * To change this template use File | Settings | File Templates.
 */

class Equip extends AppModel
{
    const MAX_EQUIP = 3;
    const TYPE_ARMOR = 'armor';
    const TYPE_WEAPON = 'weapon';
    const SET_EQUIP = 1;
    const SET_UNEQUIP = 0;
    const CLICKABLE = 2;

    /**
     * Creates equipment to character inventory.
     * @param $equip_id
     * @param $char_id
     * @param $equip_type
     * @param $equiped
     */
    public function createEquip($equip_id, $char_id, $equip_type, $equiped = self::SET_UNEQUIP)
    {
        $db = DB::conn();

        $params = array(
            'item_id' => $equip_id,
            'char_id' => $char_id,
            'item_type' => $equip_type,
            'equiped' => $equiped,
        );

        $db->insert('inventory', $params);
    }

    public static function get($equip_id, Character $character = null)
    {
        $db = DB::conn();

        $row = $db->row('SELECT * FROM equipment WHERE equip_id = ?', array($equip_id));

        if (!$row) {
            throw new RecordNotFoundException('Record not found.');
        }

        $row['character'] = $character;
        return new self($row);
    }

    public function getID()
    {
        return $this->equip_id;
    }

    public function getName()
    {
        return $this->equip_name;
    }

    public function getStat()
    {
        return $this->equip_stat;
    }

    public function getType()
    {
        return $this->equip_type;
    }

    public static function getExistingEquipByType($char_id, $type)
    {
        $db = DB::conn();
        $rows = $db->rows('SELECT item_id FROM inventory WHERE char_id = ? and item_type = ?', array($char_id, $type));

        $equip = array();
        foreach ($rows as $row) {
            $equip[] = $row['item_id'];
        }

        return $equip;
    }

    public function isEquipExisting()
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM inventory WHERE item_id = ? AND item_type = ? AND char_id = ?',
            array($this->equip_id, $this->equip_type, $this->character->char_id)
        );
        if ($row) {
            throw new ItemExistsException('Equipment already exists');
        }
        return;
    }

    public function unEquip()
    {
        $db = DB::conn();

        $db->begin();
        $params = array(
            'item_id' => $this->equip_id,
            'item_type' => $this->equip_type,
            'char_id' => $this->character->char_id
        );

        $db->update('inventory', array('equiped' => self::SET_UNEQUIP), $params);
        $db->commit();
    }
}