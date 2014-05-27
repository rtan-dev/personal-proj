<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/2/13
 * Time: 10:56 AM
 * To change this template use File | Settings | File Templates.
 */

class CharacterController extends AppController
{
    public function character_create()
    {
        is_logged_out();

        $character = new Character();
        $page = Param::get('page_next', 'character_create');
        $char_name = Param::get('charname');
        $user_name = $_SESSION['username'];

        $character->char_name = $char_name;
        $character->avatar = Param::get('avatar');
        if ($page == Character::CREATE_OK) {
            try {
                $character->create($user_name);
                $_SESSION['char_name'] = $char_name;
                $page = 'create_success';
            } catch(ValidationException $e) {
                $page = 'character_create';
            }
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function character_main()
    {
        is_char_exists();
        is_logged_out();

        $character = $this->start();
        $equip_service = $character->getServiceLocator()->getEquipService();
        $weapon = $equip_service->getEquippedWeapon();
        $armor = $equip_service->getEquippedArmor();
        $items = $character->getServiceLocator()->getItemService()->getPotions();
        $b_session = Character::isInBattle($character->getID());
        $battle = ($b_session) ? Hunt::getBattle($b_session->in_battle, $b_session->monster_id) : null;

        $this->set(get_defined_vars());
    }

    public function error()
    {

    }
}