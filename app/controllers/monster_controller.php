<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/7/13
 * Time: 12:30 PM
 * To change this template use File | Settings | File Templates.
 */

class MonsterController extends AppController
{
    const CLICKABLE = 4;
    const FIRST = 0;

    public function hunting_grounds()
    {
        is_char_exists();
        is_logged_out();

        $character = Character::get($_SESSION['username']);
        $max_level = $character->getServiceLocator()->getEquipService()->getMaxEquip();
        $monster_service = $character->getServiceLocator()->getMonsterService();
        $last_page = $monster_service->getLastPage($max_level);

        $page = page_validate(Param::get('page'), $last_page);
        $monsters = $monster_service->getAllMonsters($max_level, $page);
        $attacks = $monster_service->getMonsterAttacks();

        $b_session = Character::isInBattle($character->getID());
        $battle = ($b_session) ? Hunt::getBattle($b_session->in_battle, $b_session->monster_id) : null;

        $this->set(get_defined_vars());
    }

    public function view()
    {
        $character = Character::get($_SESSION['username']);
        $max_level = $character->getServiceLocator()->getEquipService()->getMaxEquip();
        $b_session = Character::isInBattle($character->getID());
        $battle = ($b_session) ? Hunt::getBattle($b_session->in_battle, $b_session->monster_id) : null;
        $monster = $character->getServiceLocator()->getMonsterService()->getMonster(Param::get('monster_id'));

        if ($monster) {
            if (Param::get('fight')) {
                $battle_id = $character->getServiceLocator()->getHuntService()->battleStart($monster);
                redirect('hunt/hunt', array('id' => $battle_id, 'monster_id' => $monster->getID()));
            }
        }
        else {
            redirect('monster/hunting_grounds');
        }

        $this->set(get_defined_vars());
    }
}