<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/2/13
 * Time: 10:28 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="login">
    <div class="alert-container1">
        <h1 class="form-h1">Welcome <?php eh($_SESSION['username']) ?>!</h1>
        <?php header("refresh: 3; url=/".$page2) ?>
        <p class="p-alert">
            You have successfully logged in.
            <br />
            <a href="<?php eh(url($page2)) ?>">Click here to proceed.</a>
        </p>
    </div>
</div>