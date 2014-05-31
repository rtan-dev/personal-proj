<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 12/1/13
 * Time: 10:15 PM
 * To change this template use File | Settings | File Templates.
 */

class CraftController extends AppController
{
    public function crafting()
    {
        is_char_exists();
        is_logged_out();

        $character = $this->start();
        $craft_service = $character->getServiceLocator()->getCraftService();
        $equip_service = $character->getServiceLocator()->getEquipService();
        $level = $equip_service->getMaxEquip() + 1; // always show 1 level higher equipment
        $existing_armors = $equip_service->getExistingEquipByType(Equip::TYPE_ARMOR);
        $existing_weapons = $equip_service->getExistingEquipByType(Equip::TYPE_WEAPON);
        $b_session = Character::isInBattle($character->char_id);
        $battle = ($b_session) ? Hunt::getBattle($b_session->in_battle, $b_session->monster_id) : null;

        $armor_pagination = new Pagination($craft_service->getLastPage(Equip::TYPE_ARMOR, $level, $existing_armors), Param::get(Equip::TYPE_ARMOR));
        $weapon_pagination = new Pagination($craft_service->getLastPage(Equip::TYPE_WEAPON, $level, $existing_weapons), Param::get(Equip::TYPE_WEAPON));
        try {
            $weapons = Craft::getAll($weapon_pagination->getPage(), $level, Equip::TYPE_WEAPON, $existing_weapons);
            $armors = Craft::getAll($armor_pagination->getPage(), $level, Equip::TYPE_ARMOR, $existing_armors);
        } catch(RecordNotFoundException $e) {
            $this->render(Error::RECORD_NOT_FOUND);
        }

        $this->set(get_defined_vars());
    }

    public function view()
    {
        $character = Character::get($_SESSION['username']);
        $craft_materials = array();

        try {
            $equip = Equip::get(Param::get('id'), $character);
            $equip->isEquipExisting();
            $craft_service = $character->getServiceLocator()->getCraftService();
            $craft_requirements = $craft_service->getCraftRequirements($equip->getName());

            foreach ($craft_requirements as $cr) {
                $inventory_materials = $craft_service->getCraftMaterials($cr->getName());
                $cr->in_inventory = ($inventory_materials) ? $inventory_materials->getQuantity() : $inventory_materials;
                $craft_materials[] = $cr;
            }

            if (Param::get('craft')) {
                $craft_service->craftItem($equip, $craft_materials);
                redirect('craft/craft_success', array('id' => $equip->equip_id));
            }
        } catch(RecordNotFoundException $e) {
            $this->render(Error::RECORD_NOT_FOUND);
        } catch(NotEnoughMaterialsException $e) {
            $this->render(Error::NOT_ENOUGH_MATERIALS);
        } catch(ItemExistsException $e) {
            $this->render(Error::EQUIP_EXISTS);
        }

        $this->set(get_defined_vars());
    }

    public function craft_success()
    {
        $character = $this->start();
        try {
            $equip = Equip::get(Param::get('id'), $character);
            $equip->isEquipExisting();
        } catch (RecordNotFoundException $e) {
            redirect('craft/crafting');
        } catch(ItemExistsException $e) {
            $this->render(Error::EQUIP_EXISTS);
        }
        $this->set(get_defined_vars());
    }
}