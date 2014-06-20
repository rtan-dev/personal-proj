<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 12/1/13
 * Time: 10:16 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<body id="craft">
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
<div class="crafting">
<div class="craft-container">
    <h1 class="container-h1">Crafting</h1>
    <div class="craft-content1">
        <table>
            <tr><td class="inventory-header"><strong><span class="h1-equip-type">Weapons</span></strong></td></tr>
            <?php foreach ($weapons as $weapon) : ?>
                <tr>
                    <td>
                        <div class="equip-inventory-box equip-inventory-hover">
                            <a style="text-decoration: none" href="<?php eh(url('craft/view', array('id' => $weapon->equip_id))) ?>">
                                <img src="/bootstrap/img/Weapons/weapon<?php eh($weapon->equip_id)?>-80x80.jpg">
                            </a>
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
                </tr>
            <?php endforeach ?>
        </table>
        <span style="text-decoration: none"><?php echo $weapon_pagination->paginate(Equip::CLICKABLE, Equip::TYPE_WEAPON); ?></span>
    </div>
    <div class="craft-content2">
        <table>
            <tr><td class="inventory-header"><strong><span class="h1-equip-type">Armors</span></strong></td></tr>
            <?php foreach ($armors as $armor) : ?>
                <tr>
                    <td>
                        <div class="equip-inventory-box equip-inventory-hover">
                            <a style="text-decoration: none" href="<?php eh(url('craft/view', array('id' => $armor->equip_id))) ?>">
                                <img src="/bootstrap/img/Armors/armor<?php eh($armor->equip_id);eh(get_gender($character->avatar))?>-80x80.jpg">
                            </a>
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
                </tr>
            <?php endforeach ?>
        </table>
        <span style="text-decoration: none"><?php echo $armor_pagination->paginate(Equip::CLICKABLE, Equip::TYPE_ARMOR); ?></span>
    </div>
</div>
</div>
<?php endif ?>
</body>