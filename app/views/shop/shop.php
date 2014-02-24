<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/4/13
 * Time: 4:35 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<body id="shop">
<?php if($battle): ?>
    <div class="view">
        <h1 class="b-h1">You are currently hunting!</h1>
        <div class="v-monster-container">
            <div class="monster-tag"><?php eh($battle->mon_name)?></div>
            <div class="v-monster-box">
                <img src="/bootstrap/img/Monsters/monster<?php eh($battle->monster_id)?>-big-350x350.png">
            </div>
            <a href="<?php eh(url('hunt/hunt', array('id' => $battle->battle_id, 'monster_id' => $battle->monster_id))) ?>">
                Click here to finish the hunt.
            </a>
        </div>
    </div>
<?php else : ?>
<div class="content">
<div class="shop-container">
    <h1 class="container-h1">Shop</h1>
    <form method="post" action="#">
        <table style="border: 0px">
            <tr>
                <td style="border: 0px">
                    <span class="span-equips">Zeny</span> :
                    <span id="wallet"><?php eh($character->zeny)?></span>
                </td>
            </tr>
            <tr>
                <td><span class="span-equips">Item Name</span></td>
                <td><span class="span-equips">Price</span></td>
                <td><span class="span-equips">Description</span></td>
            </tr>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td>
                    <div id="div<?php eh($item->item_id)?>" class="td-item"
                         onclick="setPotion('item_name<?php eh($item->item_id)?>', 'quantity', 'price<?php eh($item->item_id) ?>',
                             'item_id<?php eh($item->item_id)?>', 'div<?php eh($item->item_id)?>')">
                    <input type="hidden" id="item_name<?php eh($item->item_id)?>" value="<?php eh($item->item_name)?>">
                    <input type="hidden" id="item_id<?php eh($item->item_id)?>" value="<?php eh($item->item_id)?>">
                    <img src="/bootstrap/img/Items/item<?php eh($item->item_id) ?>-50x50.png"><?php eh($item->item_name)?>
                    </div>
                </td>
                <td><span id="price<?php eh($item->item_id) ?>"><?php eh($item->shop_value)?></span> Zeny</td>
                <td><?php eh($item->item_description)?></td>
            </tr>
        <?php endforeach ?>
        <?php foreach ($potions as $potion) : ?>
            <input type="hidden" id="<?php eh($potion->item_name)?>" value="<?php eh($potion->quantity)?>">
        <?php endforeach ?>
        </table>
        <input type="hidden" id="potion_qty" value="0">
        <input type="hidden" name="page_next" value="shop_end">
        <div class="buy-container">
            <input type="submit" id="btn_submit" style="margin-left: 8px" value="Buy" disabled>
        </div>
        <input name="ptn_qty_min" type="hidden" id="ptn_qty_min" value="0">
        <input name="ptn_qty_count" type="hidden" id="ptn_qty_count" value="0">
        <input name="ptn_qty_max" type="hidden" id="ptn_qty_max" value="0">
        <input name="total_price" type="hidden" id="total_price" value="0">
        <input name="price" type="hidden" id="price" value="0">
        <input name="inv_id" type="hidden" id="inv_id" value="0">
        <input name="max_price" type="hidden" id="max_price" value="0">
        <input name="item_name" type="hidden" id="item_name" value="">
    </form>
    <div id="quantity" class="hidden">
        <span style="color: lightgreen">In Inventory : </span><span id="in_inventory"></span>/10
        <span style="color: lightgreen">Buy : </span><span id="ptn_qty"></span>/<span id="max_ptn_qty"></span>
        <br />
        <a class="left-small" href="#" onclick="decrementItem('ptn_qty_count')">«</a>
        <a class="right-small" href="#" onclick="incrementItem('ptn_qty_count')">»</a>
    </div>
    <?php if(isset($name)) : ?>
        <div class="shop-log">
            You bought <?php eh($count . ' ' . $name . '/s.') ?>
        </div>
    <?php endif ?>
</div>
</div>
<?php endif ?>
</body>
<script type="text/javascript" src="/js/script.js"></script>

