<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 1/31/14
 * Time: 9:16 AM
 */

class ServiceLocator
{
    private $service;
    private $char = array();
    private $character;

    public function __construct($service, Character $character)
    {
        $this->char['character'] = $character;
        $this->character = $character;
        $this->service = ($service) ? $service : null;
    }

    public function getService()
    {
        switch ($this->service) {
            case 'craft':
                return new Craft($this->char);
            case 'equip':
                return new Equip($this->char);
            case 'hunt':
                return new Hunt($this->char);
            case 'item':
                return new Item($this->char);
            case 'rank':
                return new Rank($this->char);
            case 'shop':
                return new Shop($this->char);
            default:
                throw new ServiceNotFoundException('Invalid service type requested');
        }
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

    }
}