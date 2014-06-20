<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 1/31/14
 * Time: 9:16 AM
 */

class ServiceLocator
{
    private $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function getCraftService()
    {
        return new CraftService($this->character);
    }

    public function getEquipService()
    {
        return new EquipService($this->character);
    }

    public function getHuntService()
    {
        return new HuntService($this->character);
    }

    public function getItemService()
    {
        return new ItemService($this->character);
    }

    public function getMonsterService()
    {
        return new MonsterService($this->character);
    }

    public function getRankService()
    {
        return new RankService($this->character);
    }

    public function getShopService()
    {
        return new ShopService($this->character);
    }

    public function getQuestService()
    {
        return new QuestService($this->character);
    }
}