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
        <h1 class="header" style="margin-left: 120px;">You Died!</h1>
        <p class="win-container">
            You were slain by <?php eh($monster->monster_name) ?>!
            <br />
            Hunt weaker monsters for stronger equipment and try killing <?php eh($monster->monster_name) ?> again.
            <br />
            <a href="<?php eh(url('monster/hunting_grounds')) ?>">Click here to hunt again.</a>
        </p>
    </div>
</div>