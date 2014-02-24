<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/2/13
 * Time: 10:11 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="login">
    <div class="alert-container1">
        <h1 class="form-h1">Registration Success!</h1>
        <?php // header("refresh: 3; url=/user/login") ?>
        <p class="p-container">
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            You are now registered.
        </p>
        <p class="p-alert">
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="<?php eh(url('user/login')) ?>">Click here to log in.</a>
        </p>
    </div>
</div>