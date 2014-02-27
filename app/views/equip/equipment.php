<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/6/13
 * Time: 11:35 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<body id="equipment">
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
<div class="equips">
<div class="equip-container">
    <h1 class="container-h1">Equipment</h1>
    <form method="post" action="#">
    <div class="inner-content1">
        <table>
            <tr><td class="inventory-header"><strong><span class="h1-equip-type">Weapons</span></strong></td></tr>
            <?php foreach ($weapons as $weapon) : ?>
                <tr>
                    <td>
                        <div class="equip-inventory-box equip-inventory-hover">
                            <img src="/bootstrap/img/Weapons/weapon<?php eh($weapon->equip_id)?>-80x80.jpg"
                                 onclick="setEquip('wname<?php eh($weapon->equip_id)?>', 'weapon_stat<?php eh($weapon->equip_id)?>',
                                     'type_weapon','w_id<?php eh($weapon->equip_id)?>','weapon_lvl<?php eh($weapon->equip_id)?>')">
                            <br />
                            <span id="wname<?php eh($weapon->equip_id)?>" class="span-equips">
                                <?php eh($weapon->equip_name) ?>
                            </span>
                            <br />
                            <span class="span-equips">Damage : </span>
                            <span id="weapon_stat<?php eh($weapon->equip_id)?>"><?php eh($weapon->equip_stat) ?></span>
                            <br />
                            <span class="span-equips">Type : </span>
                            <?php eh(ucfirst($weapon->equip_elem)) ?>
                            <img src="<?php eh(get_element($weapon->equip_elem, $weapon->equip_type))?>.png">
                            <br />
                            <span class="span-equips">Equip Level : </span>
                            <span id="weapon_lvl<?php eh($weapon->equip_id)?>"><?php eh($weapon->equip_level) ?></span>
                        </div>
                    </td>
                    <input type="hidden" id="w_id<?php eh($weapon->equip_id)?>" value="<?php eh($weapon->equip_id)?>">
                </tr>
            <?php endforeach ?>
            <input type="hidden" id="type_weapon" value="weapon">
        </table>
        <span style="text-decoration: none"><?php echo pagination($weapon_last_page, $weapon_page, Equip::CLICKABLE, Equip::TYPE_WEAPON); ?></span>
    </div>
    <div class="inner-content2">
        <table>
            <tr><td class="inventory-header"><strong><span class="h1-equip-type">Armors</span></strong></td></tr>
            <?php foreach ($armors as $armor) : ?>
                <tr>
                    <td>
                        <div class="equip-inventory-box equip-inventory-hover">
                            <img src="/bootstrap/img/Armors/armor<?php eh($armor->equip_id);eh(get_gender($character->avatar))?>-80x80.jpg"
                                 onclick="setEquip('aname<?php eh($armor->equip_id)?>',
                                     'armor_stat<?php eh($armor->equip_id)?>',
                                     'type_armor','a_id<?php eh($armor->equip_id)?>',
                                     'armor_lvl<?php eh($armor->equip_id)?>')">
                            <br />
                            <span id="aname<?php eh($armor->equip_id)?>" class="span-equips">
                                <?php eh($armor->equip_name) ?>
                            </span>
                            <br />
                            <span class="span-equips">Armor : </span>
                            <span id="armor_stat<?php eh($armor->equip_id)?>"><?php eh($armor->equip_stat) ?></span>
                            <br />
                            <span class="span-equips">Type : </span>
                            <?php eh(ucfirst(convert_element($armor->equip_elem))) ?>
                            <img src="<?php eh(get_element($armor->equip_elem, $armor->equip_type))?>.png">
                            <br />
                            <span class="span-equips">Equip Level : </span>
                            <span id="armor_lvl<?php eh($armor->equip_id)?>"><?php eh($armor->equip_level) ?></span>
                        </div>
                    </td>
                    <input type="hidden" id="a_id<?php eh($armor->equip_id)?>" value="<?php eh($armor->equip_id)?>">
                </tr>
            <?php endforeach ?>
            <input type="hidden" id="type_armor" value="armor">
            <input type="hidden" class="<?php eh(get_gender($character->avatar))?>"
                   id="gender"
                   value="<?php eh(get_gender($character->avatar))?>">
        </table>
        <span style="text-decoration: none"><?php echo pagination($armor_last_page, $armor_page, Equip::CLICKABLE, Equip::TYPE_ARMOR); ?></span>
    </div>
    <div class="inner-content3">
        <table>
            <tr><td class="inventory-header"><h4><span class="h1-equip-type">Current Equipped</span></h4></td></tr>
            <tr>
                <td class="equip-box">
                    <img id="img_weapon" src="/bootstrap/img/Weapons/weapon<?php eh($equipped_weapon->equip_id)?>-200x200.jpg">
                    <input name="w_equiped_id" id="w_equiped_id" type="hidden" value="<?php eh($equipped_weapon->equip_id)?>">
                    <input name="w_equiped_type" type="hidden" value="<?php eh($equipped_weapon->equip_type)?>">
                </td>
                <td class="equip-box">
                    <img id="img_armor" src="/bootstrap/img/Armors/armor<?php eh($equipped_armor->equip_id); eh(get_gender($character->avatar))?>.jpg">
                    <input name="a_equiped_id" id="a_equiped_id" type="hidden" value="<?php eh($equipped_armor->equip_id)?>">
                    <input name="a_equiped_type" type="hidden" value="<?php eh($equipped_armor->equip_type)?>">
                </td>
            </tr>
        </table>
        <div class="e-container">
            <input id="btn_submit" type="submit" value="Equip" disabled>
            <input type="button" id="btn_click" value="Current" onclick="setCurrent()">
        </div>
        <br />
        <?php if(isset($wname) || isset($aname)) : ?>
        <div class="equip-log">
            <?php if (isset($wname)) : ?>
                You have equipped <b><?php eh($wname) ?></b>. <br />
            <?php endif ?>
            <?php if(isset($aname)) : ?>
                You have equipped <b><?php eh($aname) ?></b>. <br />
            <?php endif ?>
        </div>
        <?php endif ?>
    </div>
        <input name="damage" type="hidden" id="damage" value="0">
        <input name="armor" type="hidden" id="armor" value="0">
        <input name="weapon_id" type="hidden" id="weapon_id" value="0">
        <input name="armor_id" type="hidden" id="armor_id" value="0">
        <input name="weapon_name" type="hidden" id="weapon_name" value="">
        <input name="is_armor" type="hidden" id="is_armor" value="">
        <input name="is_weapon" type="hidden" id="is_weapon" value="">
        <input name="armor_name" type="hidden" id="armor_name" value="">
        <input name="equip_level" type="hidden" id="equip_level" value="">
        <input name="page_next" type="hidden" value="equip_end">
    </form>
</div>
</div>
<?php endif ?>
</body>
<script type="text/javascript" src="/js/script.js"></script>


