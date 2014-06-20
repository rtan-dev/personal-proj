<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/7/13
 * Time: 4:03 PM
 * To change this template use File | Settings | File Templates.
 */
?>
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
<?php elseif($max_level < $monster->monster_level): ?>
    <div class="login">
        <div class="alert-container1">
            <h1 class="form-h1">Sorry!</h1>
            <p class="p-container">
                You are not strong enough to face this monster!
                <br />
                <a href="<?php eh(url('monster/hunting_grounds')) ?>">Click here to go back to hunting page.</a>
            </p>
        </div>
    </div>
<?php else : ?>
<form method="post" action="">
    <div class="view">
        <br />
        <span class="head">Hunt >> <span class="fight">Monster</span></span>
        <h1 class="view-h1">Monster</h1>
    <div class="v-monster-container">
        <div class="monster-tag"><?php eh($monster->monster_name)?></div>
        <div class="v-monster-box">
            <img src="/bootstrap/img/Monsters/monster<?php eh($monster->monster_id)?>-big-350x350.png">
        </div>
        <div class="v-monster-description">
            <br />
            &nbsp;<span class="ecoogy-tag">Ecology</span>
            <br />
            <?php eh($monster->ecology) ?>
            <div class="f-container">
                <input type="submit" name="fight" value="Fight this monster?">
            </div>
        </div>
    </div>
    </div>
</form>
<?php endif ?>
