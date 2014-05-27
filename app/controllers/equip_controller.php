<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/2/13
 * Time: 3:54 PM
 * To change this template use File | Settings | File Templates.
 */

class EquipController extends AppController
{
    const BASE_HP = 100;
    const DEFAULT_PAGE = 1;

    public function equipment()
    {
        is_char_exists();
        is_logged_out();

        // sets new weapon equipped to be displayed in view
        if (isset($_SESSION['new_weapon']) && !empty($_SESSION['new_weapon'])) {
            $wname = $_SESSION['new_weapon'];
            unset($_SESSION['new_weapon']);
        }
        // sets new armor equipped to be displayed in view
        if(isset($_SESSION['new_armor']) && !empty($_SESSION['new_armor'])) {
            $aname = $_SESSION['new_armor'];
            unset($_SESSION['new_armor']);
        }

        $character = $this->start();
        $b_session = Character::isInBattle($character->getID());
        $battle = ($b_session) ? Hunt::getBattle($b_session->in_battle, $b_session->monster_id) : null;
        $equip_service = $character->getServiceLocator()->getEquipService();
        $armor_last_page = $equip_service->getLastPage(Equip::TYPE_ARMOR);
        $weapon_last_page = $equip_service->getLastPage(Equip::TYPE_WEAPON);

        $armor_page = page_validate(Param::get(Equip::TYPE_ARMOR), $armor_last_page);
        $weapon_page = page_validate(Param::get(Equip::TYPE_WEAPON), $weapon_last_page);

        $weapons = $equip_service->getAllWeapons($weapon_page);
        $armors = $equip_service->getAllArmors($armor_page);
        $equipped_weapon = $equip_service->getEquippedWeapon();
        $equipped_armor = $equip_service->getEquippedArmor();

        if ($_POST) {
            $equipped_weapon->setNewWeaponID(Param::get('weapon_id'))->equip();
            $equipped_armor->setNewArmorID(Param::get('armor_id'))->equip();
            redirect('equip/equipment');
        }

        $this->set(get_defined_vars());
    }
}