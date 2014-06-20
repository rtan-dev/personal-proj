<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/9/13
 * Time: 8:38 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<body id="fight">
<form method="post">
    <div class="battle">
        <br />
        <span class="head">Hunt >> Monster >> <span class="fight">Fight!</span></span>
    <div class="battle-container">
        <h1 class="b-container-h1">Hunt</h1>
        <div class="b-char-container">
            <div class="monster-tag"><?php eh($character->char_name)?></div>
            <div class="b-char-box">
                &nbsp;<img class="imgchar" src="/bootstrap/img/avatar/avatar<?php eh($character->avatar) ?>-small.jpg">
                <br />
                <br/>
                <div class="p-hp-container">
                    <div class="p-hp-tag">HP : </div>
                    <?php if (hp($character->char_hp, $character->char_max_hp)< 40) : ?>
                    <div class="p-glow">
                    <?php else : ?>
                    <div class="p-hp">
                    <?php endif ?>
                        <div class="p-max">
                            <div class="p-chp" style="width: <?php eh(hp($character->char_hp, $character->char_max_hp))?>%;">
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <br />
                &nbsp; Weapon : <span style="color: silver"><?php eh($character->char_dmg) ?></span>
                &nbsp; &nbsp; Armor : <span style="color: silver"><?php eh($character->char_armor) ?></span>
            </div>
            <div class="b-item-container">
                <div class="b-item-box">
                    &nbsp;<b>Items</b>
                    <br />
                    <?php foreach ($items as $item) : ?>
                        <div id="div<?php eh($item->item_id)?>" class="b-item">
                        <img class="item" src="/bootstrap/img/Items/item<?php eh($item->item_id)?>-50x50.png"
                             onclick="usePotion(
                                 'item_id<?php eh($item->item_id) ?>',
                                 'item_name<?php eh($item->item_id) ?>',
                                 'use_val<?php eh($item->item_id) ?>',
                                 'item_cnt<?php eh($item->item_id)?>',
                                 'item_type<?php eh($item->item_id) ?>',
                                 'div<?php eh($item->item_id)?>')">
                        <span id="item_cnt<?php eh($item->item_id)?>"><?php eh($item->quantity) ?></span>
                        <input type="hidden" id="use_val<?php eh($item->item_id) ?>" value="<?php eh($item->use_value)?>">
                        <input type="hidden" id="item_id<?php eh($item->item_id) ?>" value="<?php eh($item->item_id)?>">
                        <input type="hidden" id="item_name<?php eh($item->item_id) ?>" value="<?php eh($item->item_name)?>">
                        <input type="hidden" id="item_type<?php eh($item->item_id) ?>" value="<?php eh($item->item_type)?>">
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="b-button-container" id="button_show">
                <input id="use_item" type="submit" name="btn_item" value="Use Item" onclick="hideButton()" disabled/>
                <input id="atk_btn" type="submit" name="btn_attack" value="Attack" onclick="hideButton()"/>
            </div>
            <div class="button-hide" id="button_hide">
                <input id="use_item" type="submit" name="btn_item" value="Use Item" disabled/>
                <input id="atk_btn" type="submit" name="btn_attack" value="Attack" disabled />
            </div>
            <div class="b-char-logs-container">
                <?php echo $hunt->battle_log ?>
            </div>
        </div>
        <div class="vs-container">VS</div>
        <div class="b-monster-container">
            <div class="monster-tag"><?php eh($monster->monster_name)?></div>
            <div class="b-monster-box">
                <img src="/bootstrap/img/Monsters/monster<?php eh($monster->monster_id)?>-big.png">
            </div>
            <div class="hp-container">
                <div class="hp-tag">HP : </div>
                <?php if (hp($hunt->mon_hp, $monster->monster_max_hp) < Monster::RAGE) : ?>
                <div class="hp-glow">
                    <?php else : ?>
                    <div class="hp">
                        <?php endif ?>
                        <div class="max">
                            <div class="chp" style="width: <?php eh(hp($hunt->mon_hp, $monster->monster_max_hp))?>%;">
                            </div>
                        </div>
                    </div>
                </div>
                <br />
            <div class="b-mon-logs-container">
                <?php echo $hunt->monster_log ?>
            </div>
        </div>
        <input id="char_hp" type="hidden" name="char_hp" value="<?php eh($character->char_hp)?>">
        <input id="char_max_hp" type="hidden" name="char_max_hp" value="<?php eh($character->char_max_hp) ?>">
        <input type="hidden" name="monster_hp" value="<?php eh($hunt->mon_hp)?>">
        <input id="use_value" name="use_value" type="hidden" value="0">
        <input id="item_id" name="item_id" type="hidden" value="0">
        <input id="item_name" name="item_name" type="hidden" value="0">
        <input id="item_type" name="item_type" type="hidden" value="0">
        <input id="item_count" name="item_count" type="hidden" value="0">
    </div>
    </div>
</form>

<div>
    <?php if(isset($hunt->char_anim) && isset($hunt->mon_anim)) : ?>
        <div class="char-anim">
            <div class="anim-tag"><?php eh($character->char_name)?></div>
            <img src="/bootstrap/img/avatar/avatar<?php eh($character->avatar) ?>-big.jpg">
            <div class="hp-anim">
                <div class="anim-hp">
                    <div class="anim-max">
                        <div class="anim-chp" style="width: <?php eh(hp($character->char_hp, $character->char_max_hp))?>%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mon-anim">
            <div class="anim-tag"><?php eh($monster->monster_name)?></div>
            <img src="/bootstrap/img/Monsters/monster<?php eh($monster->monster_id)?>-big-270x270.png">
            <div class="mhp-anim">
                <div class="anim-mhp">
                    <div class="anim-mmax">
                        <div class="anim-mchp" style="width: <?php eh(hp($hunt->mon_hp, $monster->monster_max_hp))?>%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="char-dmg">
            <?php eh($hunt->char_anim) ?>
        </div>
        <div class="mon-dmg">
            <?php eh($hunt->mon_anim) ?>
        </div>
    <?php elseif (isset($hunt->char_anim) && !isset($hunt->mon_anim)) : ?>
        <div class="heal">
            <?php eh($hunt->char_anim) ?>
        </div>
    <?php endif ?>
</div>
</body>
<script type="text/javascript" src="/js/script.js"></script>
