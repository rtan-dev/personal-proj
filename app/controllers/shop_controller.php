<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/4/13
 * Time: 4:34 PM
 * To change this template use File | Settings | File Templates.
 */

class ShopController extends AppController
{
    public function shop()
    {
        is_char_exists();
        is_logged_out();

        if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
            $name = $_SESSION['name'];
            $count = $_SESSION['count'];
            unset($_SESSION['name']);
            unset($_SESSION['count']);
        }

        $character = Character::get($_SESSION['username']);
        $items = $character->getServiceLocator()->getShopService()->getShopItems();
        $potions = $character->getServiceLocator()->getItemService()->getPotions();
        $b_session = Character::isInBattle($character->char_id);
        $battle = ($b_session) ? Hunt::getBattle($b_session->in_battle, $b_session->monster_id) : null;

        if($_POST) {
            $potion_quantity = Param::get('ptn_qty_count');

            try {
                $shop_item = $character->getServiceLocator()->getShopService()->getItem(Param::get('inv_id'));
                $shop_item->setQuantity($potion_quantity + Param::get('ptn_qty_min'))->buyItem();
                $character->setZeny($character->zeny - Param::get('total_price'))->updateZeny();
                $_SESSION['count'] = $potion_quantity;
                $_SESSION['name'] = $shop_item->item_name;
                redirect('shop/shop');
            } catch(RecordNotFoundException $e) {
                redirect('error/record_not_found');
            }
        }
        $this->set(get_defined_vars());
    }
}