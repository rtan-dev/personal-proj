<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/1/13
 * Time: 9:27 PM
 * To change this template use File | Settings | File Templates.
 */

?>
<?php if ($user->hasError()) : ?>
    <div class="error error-block">
        <h4 class="alert-heading">Validation Errors!</h4>
        <?php if (!empty($user->validation_errors['username']['length'])) : ?>
            <div><em>Username must be</em> between
                <?php eh($user->validation['username']['length'][1]) ?> and
                <?php eh($user->validation['username']['length'][2]) ?>
                characters in length.
            </div>
        <?php endif ?>
        <?php if (!empty($user->validation_errors['password']['length'])) : ?>
            <div><em>Password must be</em> between
                <?php eh($user->validation['password']['length'][1]) ?> and
                <?php eh($user->validation['password']['length'][2]) ?>
                characters in length.
            </div>
        <?php endif ?>
    </div>
<?php endif ?>

<div class="login">
<form class="form-container" method="post" action="#">
    <div class="inset">
        <h1 class="form-h1">Log In</h1>
        <p>
            <label class="label" for="username">User Name</label>
            <input type="text" name="username" value="<?php eh(Param::get('username')) ?>">
        </p>
        <p>
            <label class="label" for="password">Password</label>
            <input type="password" name="password" value="<?php eh(Param::get('password')) ?>">
        </p>
    </div>
    <p class="p-container">
        <span>Not a user?<a href="<?php eh(url('user/register')) ?>"> Click Here </a></span>
        <input type="submit" value="Log In">
    </p>
    <input type="hidden" name="page_next" value="login_failed">
</form>
</div>