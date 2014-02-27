<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/9/14
 * Time: 8:54 AM
 */

class Armor extends Equip
{
    protected $new_armor_id;

    public static function getEquipped(Character $character)
    {
        $db = DB::conn();

        $row = $db->row(
            'SELECT e.* FROM equipment e INNER JOIN inventory i
            ON e.equip_id = i.item_id
            INNER JOIN characters c
            ON i.char_id = c.char_id
            WHERE i.equiped = 1 AND e.equip_type=?
            AND c.char_name = ?',
            array(self::TYPE_ARMOR, $character->char_name)
        );

        $row['character'] = $character;
        return new self($row);
    }

    public static function getAll($page, $char_name)
    {
        $db = DB::conn();
        $offset = ($page - 1) * Equip::MAX_EQUIP;

        $rows = $db->rows(
            'SELECT i.*, e.* FROM inventory i INNER JOIN equipment e
            ON i.item_id = e.equip_id
            INNER JOIN characters c
            ON i.char_id = c.char_id
            WHERE i.item_type = ? AND c.char_name = ?
            ORDER BY e.equip_level
            LIMIT ' .Equip::MAX_EQUIP. ' OFFSET '.$offset,
            array(self::TYPE_ARMOR, $char_name)
        );

        $armors = array();
        if ($rows) {
            foreach ($rows as $row) {
                $armors[] = new self($row);
            }
        }

        return $armors;
    }

    public function setNewArmorID($new_armor_id)
    {
        $this->new_armor_id = $new_armor_id;
        return $this;
    }

    public function getNewArmorId()
    {
        return $this->new_armor_id;
    }

    public function equip()
    {
        $db = DB::conn();

        if (!$this->getNewArmorId()) {
            return;
        }

        $new_armor = self::get($this->getNewArmorId());
        $equip_params = array(
            'item_id' => $new_armor->equip_id,
            'item_type' => self::TYPE_ARMOR,
            'char_id' => $this->character->char_id
        );
        $db->update('inventory', array('equiped' => self::SET_EQUIP), $equip_params);
        $hp = Character::DEFAULT_HP + hp_calculator($new_armor->equip_level);
        $this->character->setArmor($new_armor->equip_stat)->setHp($hp)->updateArmor();
        $this->unEquip();
        $_SESSION['new_armor'] = $new_armor->equip_name;
    }
}