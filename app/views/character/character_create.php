<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/2/13
 * Time: 10:58 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<?php if (isset($character->char_name)) : ?>
    <?php if ($character->hasError() || $character->isDuplicate()) : ?>
    <div class="error error-block">
        <h4 class="alert-heading">Validation Errors!</h4>
        <?php if (!empty($character->validation_errors['char_name']['length'])) : ?>
            <div><em>Character Name must be</em> between
                <?php eh($character->validation['char_name']['length'][1]) ?> and
                <?php eh($character->validation['char_name']['length'][2]) ?>
                characters in length.
            </div>
        <?php endif ?>
        <?php if (!empty($character->validation['char_name']['valid'])) : ?>
            <div><em>Invalid character name.</em> Please use
            alphanumeric characters only.
            </div>
        <?php endif ?>
        <?php if ($character->isDuplicate()) : ?>
            <div><em>Character Name already exists!</em></div>
        <?php endif ?>
        <?php if (!empty($character->validation['char_name']['valid'])) : ?>
            <div><em>Invalid character name.</em> Please use
            valid characters only.
            </div>
        <?php endif ?>
    </div>
    <?php endif ?>
<?php endif ?>
<div class="register">
    <form class="register-container" method="post" action="#">
        <h1 class="form-h1">Character Creation</h1>
        <p>
            <label class="label" for="charname">Character Name</label>
            <input type="text" name="charname" value="<?php eh(Param::get('charname')) ?>">
        </p>
        <p>
        <label class="label" for="avatar">Choose Your Avatar</label>
        <img style="margin-left: 105px" name="imgSrc" id="imgSrc">
        <table style="margin-left: 105px;" width="400" border="0" cellspacing="0" cellpadding="0" class="img-viewer">
            <tr>
                <td align="left"><a class="left-small" href="#" onClick="prev('avatar');"> «</a></td>
                <td align="right"><a class="right-small" href="#" onClick="next('avatar');"> » </a></td>
            </tr>
        </table>
        </p>
        <p class="submit-container">
            <input type="submit" value="Create">
        </p>
        <input type="hidden" id="avatar" name="avatar" value="1">
        <input type="hidden" name="page_next" value="create_success">

    </form>
</div>
<script type="text/javascript" src="/js/nextPrevious.js"></script>