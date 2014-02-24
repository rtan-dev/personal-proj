<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/2/14
 * Time: 7:37 PM
 */
?>
<div class="login">
    <div class="alert-container1">
        &nbsp;&nbsp;<h1 class="header" style="margin-left: 56px;">Congratulations!</h1>
        <p class="win-container">
You crafted <?php eh($equip->equip_name) ?>!
<br />
<?php if ($equip->equip_type == Equip::TYPE_WEAPON) :?>
    <img src="/bootstrap/img/Weapons/weapon<?php eh($equip->equip_id) ?>-80x80.jpg">
<?php elseif ($equip->equip_type == Equip::TYPE_ARMOR) : ?>
    <img src="/bootstrap/img/Armors/armor<?php eh($equip->equip_id);eh(get_gender($character->avatar)) ?>-80x80.jpg">
<?php endif ?>
<br />
<br />
<a href="<?php eh(url('character/character_main')) ?>">Click here to go to main.</a>
</p>
</div>
</div>