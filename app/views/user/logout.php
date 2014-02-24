<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/2/13
 * Time: 11:32 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<?php if (!isset($_SESSION['username'])) : ?>
    <?php redirect('user/login') ?>
<?php endif ?>
<div class="alert-container1">
    <h1 class="form-h1">Good Bye!</h1>
    <p class="p-container">
        You have logged out.
    </p>
    <a href="<?php eh(url('user/login'))?>">Back to Login Page</a>
</div>