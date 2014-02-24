<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/2/13
 * Time: 10:59 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<body id="char_main">
<?php if($battle): ?>
    <div class="view">
        <h1 class="b-container-h1">You are currently hunting!</h1>
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
<div class="container1">
    <h1 class="home-h1">Character Page</h1>
    <div class="c-box">
<div class="inner-content">
    <div class="box1">
        <h1 class="h1-char-name"><?php eh($character->char_name) ?></h1>
        <img class="img" src="/bootstrap/img/avatar/avatar<?php eh($character->avatar) ?>.jpg">
    </div>
    <div class="box2">
        <table class="char-table">
            <tr><td class="inventory-header"><h4><span class="span-equips">Stats</span></h4></td></tr>
            <tr>
                <td><b><span class="span-equips">HP : </span></b></td>
                <td><span class="cstats"><?php eh($character->char_hp) ?></span></td>
            </tr>
            <tr>
                <td><b><span class="span-equips">Damage : </span></b></td>
                <td><span class="cstats"><?php eh($character->char_dmg) ?></span></td>
            </tr>
            <tr>
                <td><b><span class="span-equips">Armor : </span></b></td>
                <td><span class="cstats"><?php eh($character->char_armor) ?></span></td>
            </tr>
            <tr>
                <td><b><span class="span-equips">Zeny : </span></b></td>
                <td><span class="cstats"><?php eh($character->zeny) ?></span></td>
            </tr>
        </table>
    </div>
</div>
<div class="inner-content">
    <table style="border: 0px">
        <tr><td class="inventory-header"><h4><span class="h1-equip-header">Equips</span></h4></td></tr>
        <tr>
            <td>
                <div class="equip-box w-equip-box" >
                    <div style="display: inline-block;vertical-align: top">
                        <img src="/bootstrap/img/Weapons/weapon<?php eh($weapon->equip_id)?>-200x200.jpg">
                    </div>
                    <div style="display: inline-block;">
                        <div>
                            <span id="wname<?php eh($weapon->equip_id)?>" class="span-equips">
                                <?php eh($weapon->equip_name) ?>
                            </span>
                        </div>
                        <div>
                            <span class="span-equips">Damage : </span>
                            <span id="weapon_stat<?php eh($weapon->equip_id)?>"><?php eh($weapon->equip_stat) ?></span>
                        </div>
                        <div>
                            <span class="span-equips">Type : </span>
                            <?php eh(ucfirst($weapon->equip_elem)) ?>
                            <img src="<?php eh(get_element($weapon->equip_elem, $weapon->equip_type))?>.png">
                        </div>
                        <div>
                            <span class="span-equips">Equip Level : </span>
                            <span id="weapon_lvl<?php eh($weapon->equip_id)?>"><?php eh($weapon->equip_level) ?></span>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div class="equip-box a-equip-box" >
                    <div style="display: inline-block;vertical-align: top">
                        <img src="/bootstrap/img/Armors/armor<?php eh($armor->equip_id); eh(get_gender($character->avatar))?>.jpg">
                    </div>
                    <div style="display: inline-block;">
                        <div>
                            <span id="aname<?php eh($armor->equip_id)?>" class="span-equips">
                                <?php eh($armor->equip_name) ?>
                            </span>
                        </div>
                        <div>
                            <span class="span-equips">Armor : </span>
                            <span id="armor_stat<?php eh($armor->equip_id)?>"><?php eh($armor->equip_stat) ?></span>
                        </div>
                        <div>
                            <span class="span-equips">Type : </span>
                            <?php eh(ucfirst(convert_element($armor->equip_elem))) ?>
                            <img src="<?php eh(get_element($armor->equip_elem, $armor->equip_type))?>.png">
                        </div>
                        <div>
                            <span class="span-equips">Equip Level : </span>
                            <span id="armor_lvl<?php eh($armor->equip_id)?>"><?php eh($armor->equip_level) ?></span>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
<?php if($items) : ?>
    <div class="item-content">
        <table style="border: 0px">
            <tr><td class="inventory-header"><h4><span class="span-header">Items</span></h4></td></tr>
            <tr>
            <?php foreach($items as $item) : ?>
                <td class="inventory-font">
                    <img src="/bootstrap/img/Items/item<?php eh($item->item_id) ?>-50x50.png">
                    <span style="color: dodgerblue"><?php eh($item->item_name) ?></span> x
                    <?php eh($item->quantity) ?>
                </td>
            <?php endforeach ?>
            </tr>
        </table>
    </div>
<?php endif ?>
<div class="clear"></div>
    </div>
</div>
<?php endif ?>
</body>
