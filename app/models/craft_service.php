<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/8/14
 * Time: 7:30 PM
 */

class CraftService
{
    private $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function craftItem(Equip $equip, $craft_materials = array())
    {
        $equip_service = $this->character->getServiceLocator()->getEquipService();
        $this->validateMaterials($craft_materials);
        $equip_service->create($equip->getID(), $equip->getType());
        foreach ($craft_materials as $craft_material) {
            $craft_material->decr($craft_material->getInInventory(), $craft_material->getQuantity());
        }
    }

    public function getCraftRequirements($equip_name)
    {
        return Craft::getCraftRequirements($this->character, $equip_name);
    }

    public function getCraftMaterials($item_name)
    {
        return CraftMaterial::getMaterials($this->character, $item_name);
    }

    public function getLastPage($type, $level, $equips = array())
    {
        $db = DB::conn();

        $row_count = $db->value(
            'SELECT COUNT(*) FROM equipment
            WHERE equip_level <= ? AND equip_type = ? AND equip_id NOT IN (?) AND monster_id',
            array($level, $type, $equips)
        );

        return ceil($row_count / Craft::MAX_PAGE);
    }

    public function validateMaterials($craft_materials)
    {
        foreach ($craft_materials as $craft_material) {
            $craft_material->validate();
        }
    }
}