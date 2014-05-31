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

        // sets newly equipped to be displayed in view
        $wname = set_new_equip('new_weapon');
        $aname = set_new_equip('new_armor');

        $character = $this->start();
        $b_session = Character::isInBattle($character->getID());
        $battle = ($b_session) ? Hunt::getBattle($b_session->in_battle, $b_session->monster_id) : null;
        $equip_service = $character->getServiceLocator()->getEquipService();
        $armor_pagination = new Pagination(Param::get(Equip::TYPE_ARMOR), $equip_service->getLastPage(Equip::TYPE_ARMOR));
        $weapon_pagination = new Pagination(Param::get(Equip::TYPE_WEAPON), $equip_service->getLastPage(Equip::TYPE_WEAPON));

        $weapons = $equip_service->getAllWeapons($weapon_pagination->getPage());
        $armors = $equip_service->getAllArmors($armor_pagination->getPage());
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