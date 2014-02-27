<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/8/14
 * Time: 7:35 PM
 */
class EquipService
{
    private $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function create($equip_id, $type, $equipped = Equip::SET_UNEQUIP)
    {
        $db = DB::conn();

        $params = array(
            'item_id' => $equip_id,
            'char_id' => $this->character->getID(),
            'item_type' => $type,
            'equiped' => $equipped,
        );

        $db->insert('inventory', $params);
    }

    public function getLastPage($type)
    {
        $db = DB::conn();
        $row_count = $db->value('SELECT COUNT(*) FROM inventory WHERE item_type=? AND char_id=? LIMIT 1',
            array($type, $this->character->getID()));

        return ceil($row_count / Equip::MAX_EQUIP);
    }

    public function get($equip_id)
    {
        return Equip::get($equip_id, $this->character);
    }

    public function getAllArmors($page)
    {
        return Armor::getAll($page, $this->character->getName());
    }

    public function getAllWeapons($page)
    {
        return Weapon::getAll($page, $this->character->getName());
    }

    public function getMaxEquip()
    {
        $db = DB::conn();

        $max_level = $db->value(
            'SELECT MAX(e.equip_level) FROM equipment e INNER JOIN inventory i
            ON e.equip_id = i.item_id
            WHERE i.item_type IN (\'armor\',\'weapon\') AND i.char_id = ? LIMIT 1',
            array($this->character->getID())
        );

        return $max_level;
    }

    public function getEquippedArmor()
    {
        return Armor::getEquipped($this->character);
    }

    public function getEquippedWeapon()
    {
        return Weapon::getEquipped($this->character);
    }

    public function getExistingEquipByType($type)
    {
        return Equip::getExistingEquipByType($this->character->getID(), $type);
    }
}