<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/1/13
 * Time: 9:47 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<?php if (isset($user->username) && isset($user->email)) : ?>
<?php if ($user->hasError() || $user->isUserExisting() ||
        (!is_null($user->rep_password) && !$user->isPasswordMatching()) || $user->isEmailExists()): ?>
        <div class="error error-block">
            <h4 class="alert-heading">Validation Errors!</h4>
            <?php if (!empty($user->validation['username']['valid'])) : ?>
                <div><em>Invalid user name.</em> Please use
                valid characters only.
                </div>
            <?php endif ?>
            <?php if ($user->isUserExisting()) : ?>
                <div><em>Username exists!</em></div>
            <?php endif ?>
            <?php if (!empty($user->validation['username']['valid'])) : ?>
                <div><em>Invalid user name.</em> Please use
                alphanumeric characters only.
                </div>
            <?php endif ?>
            <?php if (!$user->isPasswordMatching()) : ?>
                <div><em>Passwords does not match!</em></div>
            <?php endif ?>
            <?php if ($user->isEmailExists()) : ?>
                <div><em>Email exists!</em></div>
            <?php endif ?>
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
            <?php if (!empty($user->validation_errors['email']['valid'])) : ?>
                <div><em>Invalid e-mail format!</em></div>
            <?php endif ?>
        </div>
<?php endif ?>
<?php endif ?>
<div class="register">
<form class="register-container" method="post" action="#">
    <div class="inset">
        <h1 class="form-h1">Register</h1>
        <p>
            <label class="label" for="username">User Name</label>
            <input type="text" name="username" value="<?php eh(Param::get('username')) ?>">
        </p>
        <p>
            <label class="label" for="password">Password</label>
            <input type="password" name="password" value="<?php eh(Param::get('password')) ?>">
        </p>
        <p>
            <label class="label" for="rep_pass">Repeat Password</label>
            <input type="password" name="rep_pass" value="<?php eh(Param::get('rep_pass')) ?>">
        </p>
        <p>
            <label class="label" for="email">E-mail</label>
            <input type="text" name="email" value="<?php eh(Param::get('email')) ?>">
        </p>
        <input type="hidden" name="page_next" value="register_end">
        <p class="p-container">
            <input type="submit" name="submit">
            <span><a href="<?php eh(url('user/login')) ?>">Back</a>&nbsp; to Log In</span>
        </p>
    </div>
</form>
</div>