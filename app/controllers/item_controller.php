<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/4/13
 * Time: 4:49 PM
 * To change this template use File | Settings | File Templates.
 */

class ItemController extends AppController
{
    public function index()
    {
        $character = $this->start();
        $tab = Param::get('tab', 'potions');

        switch ($tab) {
            case Item::ITEM_TYPE_USEABLE:
                break;
            case Item::ITEM_TYPE_LOOT:
        }

        $this->set(get_defined_vars());
    }
}