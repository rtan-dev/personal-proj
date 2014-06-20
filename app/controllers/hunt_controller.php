<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/7/13
 * Time: 4:03 PM
 * To change this template use File | Settings | File Templates.
 */

class HuntController extends AppController
{
    function hunt()
    {
        is_char_exists();
        is_logged_out();

        $character = $this->start();
        $monster = $character->getServiceLocator()->getMonsterService()->getMonster(Param::get('monster_id'));
        $items = $character->getServiceLocator()->getItemService()->getPotions();
        $weapon = $character->getServiceLocator()->getEquipService()->getEquippedWeapon();
        $armor = $character->getServiceLocator()->getEquipService()->getEquippedArmor();
        $battle_id = Param::get('id');
        $hunt = Hunt::getBattle($battle_id, $monster->monster_id);

        $_SESSION['hunt'] = $battle_id;
        $_SESSION['m_id'] = $monster->monster_id;

        $hunt->setAnimation();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // check if attack button is clicked
            if (Param::get('btn_attack')) {
                $attack = $monster->getRandomMonsterAttack($character, $armor);
                $monster_dmg = $monster->is_enraged($hunt->mon_hp) ? $attack->getRageDamage() : $attack->getDamage();

                $win = $hunt->monsterBattle(
                    $hunt->computeCharDmg(random_damage($character->char_dmg), $weapon->equip_elem, $monster),
                    $monster_dmg,
                    $monster,
                    $character,
                    $attack->attack_name
                );

                if ($win == Hunt::WIN) {
                    redirect('hunt/win', array('id' => $battle_id, 'monster_id' => $monster->monster_id));
                } elseif ($win == Hunt::LOSE) {
                    redirect('hunt/lose', array('id' => $battle_id, 'monster_id' => $monster->monster_id));
                }
                redirect('hunt/hunt', array('id' => $battle_id, 'monster_id' => $monster->monster_id));
            }
            // check if use item button is clicked
            if (Param::get('btn_item')) {
                $item_name = Param::get('item_name');
                $use_value = Param::get('use_value');
                $item_id = Param::get('item_id');
                $item_count = Param::get('item_count');
                $hunt->useItem($item_id, $item_name, $use_value, $item_count, $character);

                redirect('hunt/hunt', array('id' => $battle_id, 'monster_id' => $monster->monster_id));
            }
        }

        $this->set(get_defined_vars());
    }

    public function lose()
    {
        is_battle_over();
        unset($_SESSION['hunt']);
        unset($_SESSION['m_id']);

        $monster = Monster::get(Param::get('monster_id'));

        $this->set(get_defined_vars());
    }

    public function win()
    {
        is_battle_over();

        unset($_SESSION['hunt']);
        unset($_SESSION['m_id']);

        $char = $this->start();
        $monster = $char->getServiceLocator()->getMonsterService()->getMonster(Param::get('monster_id'));
        $item_service = $char->getServiceLocator()->getItemService();
        $loots = $item_service->getLoots($monster->getID());

        foreach ($loots as $loot) {
            try {
                $item = $item_service->getFromInventory(Item::ITEM_TYPE_LOOT, $loot->item_id);
                $item->incr();
            } catch(RecordNotFoundException $e) {
                Item::create($loot->item_id, Item::ITEM_TYPE_LOOT, $char->getID(), Item::DEFAULT_QUANTITY);
            }
        }

        $this->set(get_defined_vars());
    }
}