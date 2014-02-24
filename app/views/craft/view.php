<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 1/11/14
 * Time: 12:35 PM
 */
?>
<form method="post" action="">
    <div class="view">
        <br />
        <span class="head">Craft >> <span class="fight">View</span></span>
        <h1 class="view-h1">Craft</h1>
        <div class="v-monster-container">
            <div class="monster-tag"><?php eh($equip->equip_name)?></div>
            <div class="craft-box">
                <?php if ($equip->equip_type == Equip::TYPE_WEAPON) :?>
                    <img src="/bootstrap/img/Weapons/weapon<?php eh($equip->equip_id) ?>-200x200.jpg">
                <?php elseif ($equip->equip_type == Equip::TYPE_ARMOR) : ?>
                    <img src="/bootstrap/img/Armors/armor<?php eh($equip->equip_id);eh(get_gender($character->avatar)) ?>.jpg">
                <?php endif ?>
            </div>
            <div class="v-monster-description">
                <br />
                &nbsp;<span class="ecoogy-tag">Materials</span>
                <br />
                <?php foreach ($craft_materials as $craft_material) : ?>
                    <?php eh($craft_material->item_name) ?>
                    <?php eh($craft_material->in_inventory) ?>/<?php eh($craft_material->quantity) ?><br/>
                <?php endforeach ?>
                <div class="f-container">
                    <input type="submit" name="craft" value="Craft this item?">
                </div>
            </div>
        </div>
    </div>
</form>