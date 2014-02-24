<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/8/14
 * Time: 7:31 PM
 */
class ShopService
{
    private $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function getItem($item_id)
    {
        return Shop::get($item_id, $this->character);
    }

    public function getShopItems()
    {
        return Item::getUseableItems();
    }
}