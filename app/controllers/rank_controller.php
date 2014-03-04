<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/11/13
 * Time: 10:50 AM
 * To change this template use File | Settings | File Templates.
 */

class RankController extends AppController
{
    public function rankings()
    {
        is_char_exists();
        is_logged_out();

        $character = Character::get($_SESSION['username']);
        $b_session = Character::isInBattle($character->char_id);
        $battle = ($b_session) ? Hunt::getBattle($b_session->in_battle, $b_session->monster_id) : null;
        $rank_service = $character->getServiceLocator()->getRankService();
        $kill_death = $rank_service->getKillDeathRatio();
        $score = $rank_service->getTotalScore();

        $this->set(get_defined_vars());
    }

    public function view()
    {
        is_logged_out();

        $character = Rank::getCharInfo(Param::get('id'));
        $weapon = $character->getServiceLocator()->getEquipService()->getEquippedWeapon();
        $armor = $character->getServiceLocator()->getEquipService()->getEquippedArmor();
        $your_char = Character::get($_SESSION['username']);
        $b_session = Character::isInBattle($your_char->char_id);
        $battle = ($b_session) ? Hunt::getBattle($b_session->in_battle, $b_session->monster_id) : null;

        $this->set(get_defined_vars());
    }
}