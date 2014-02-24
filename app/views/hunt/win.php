<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/9/13
 * Time: 12:15 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="login">
    <div class="alert-container1">
        &nbsp;&nbsp;<h1 class="header" style="margin-left: 56px;">Congratulations!</h1>
        <p class="win-container">
            You defeated <?php eh($monster->monster_name) ?>!
            <br />
            You received <?php eh($monster->monster_zeny) ?>!
            <br />
            <?php foreach ($loots as $loot) : ?>
                <?php eh($loot->item_name) ?><br />
            <?php endforeach ?>
            <br />
            <a href="<?php eh(url('monster/hunting_grounds')) ?>">Click here to hunt again.</a>
        </p>
    </div>
</div>