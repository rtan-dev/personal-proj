<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/2/13
 * Time: 5:05 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="login">
    <div class="alert-container1">
        <h1 class="form-h1">Character creation successful.</h1>
        <?php header("refresh: 3; url=/character/character_main") ?>
        <p class="p-alert">
            Welcome Hunter, <?php eh($_SESSION['char_name']) ?>!
            <br />
            <a href="<?php eh(url('character/character_main')) ?>">Click here to play.</a>
        </p>
    </div>
</div>
