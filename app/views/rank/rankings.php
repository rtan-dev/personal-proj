<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/11/13
 * Time: 10:50 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<body id="rankings">
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
<?php else : ?>
<div class="topscore">
<div class="rank-container">
    <h1 class="container-h1">Player Rankings</h1>
    <h4><span class="rank-header">Top 10 Monster Kills</span></h4>
    <table id="space">
        <tr>
            <td class="ranks">Player Name</td>
            <td class="ranks">Monster Kills</td>
            <td class="ranks">Player Deaths</td>
        </tr>
        <?php foreach($kill_death as $kd) : ?>
            <tr>
                <td class="players">
                    <a class="rank-no-line" href="<?php eh(url('rank/view', array('id' => $kd->char_id))) ?>">
                        <?php eh($kd->char_name) ?>
                    </a>
                </td>
                <td class="players"><?php eh($kd->monster_kills) ?></td>
                <td class="players"><?php eh($kd->player_deaths) ?></td>
            </tr>
        <?php endforeach ?>
    </table>
    <h4><span class="rank-header">Top 10 Kill Score</span></h4>
    <table id="space">
        <tr>
            <td class="ranks">Player Name</td>
            <td class="ranks">Total Score</td>
        </tr>
        <?php foreach($score as $s) : ?>
            <tr>
                <td class="players">
                    <a class="rank-no-line" href="<?php eh(url('rank/view', array('id' => $s->char_id))) ?>">
                        <?php eh($s->char_name) ?>
                    </a>
                </td>
                <td class="players"><?php eh($s->total_score) ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
</div>
<?php endif ?>
</body>

