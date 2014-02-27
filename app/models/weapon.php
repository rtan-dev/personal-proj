<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/9/14
 * Time: 8:54 AM
 */
class Weapon extends Equip
{
    protected $new_weapon_id;

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
            array(self::TYPE_WEAPON, $character->char_name)
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
            array(self::TYPE_WEAPON, $char_name)
        );

        $weapons = array();
        if ($rows) {
            foreach ($rows as $row) {
                $weapons[] = new self($row);
            }
        }

        return $weapons;
    }

    public function setNewWeaponID($new_weapon_id)
    {
        $this->new_weapon_id = $new_weapon_id;
        return $this;
    }

    public function getNewWeaponId()
    {
        return $this->new_weapon_id;
    }

    public function equip()
    {
        $db = DB::conn();

        if (!$this->getNewWeaponId()) {
            return;
        }

        $new_weapon = self::get($this->getNewWeaponId());
        $equip_params = array(
            'item_id' => $new_weapon->equip_id,
            'item_type' => self::TYPE_WEAPON,
            'char_id' => $this->character->char_id
        );
        $db->update('inventory', array('equiped' => self::SET_EQUIP), $equip_params);
        $this->character->setDamage($new_weapon->equip_stat)->updateDamage();
        $this->unEquip();
        $_SESSION['new_weapon'] = $new_weapon->equip_name;
    }
}