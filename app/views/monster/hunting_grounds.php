<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/7/13
 * Time: 12:30 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<body id="hunt_grounds">
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
<div class="content2">
<form method="get" action="">
<div class="monster-container">
    <h1 class="h-container-h1">Hunting Grounds</h1>
    <span class="mon-span"><<< Monster >>></span>
    <span class="atk-span"><<<< Attacks >>>></span>
    <?php foreach ($monsters as $key => $monster) : ?>
        <?php if($key == MonsterController::FIRST) : ?>
            <a class="no-line" href="<?php eh(url('monster/view',array('monster_id' => $monster->monster_id))) ?>">
                <div class="first-monster-content">
                    <div class="monster-box">
                        <img src="/bootstrap/img/Monsters/monster<?php eh($monster->monster_id)?>-small.jpg">
                    </div>
                    <div class="tag">
                        <div class="mname">
                            <?php eh($monster->monster_name) ?>
                        </div>
                        <div class="mlvel">
                            Monster Level : <span style="color: #fcfcfc"><?php eh($monster->monster_level) ?></span>
                        </div>
                        <div class="mlvel">
                            Weakness : <span style="color: #fcfcfc"><?php eh(ucfirst($monster->monster_weakness)) ?></span>
                        </div>
                        <div class="mlvel">
                            Resistance : <span style="color: #fcfcfc"><?php eh(ucfirst($monster->monster_resist)) ?></span>
                        </div>
                    </div>
                    <div class="atk">
                        <?php foreach ($attacks as $attack) : ?>
                            <?php if ($attack->monster_name == $monster->monster_name) : ?>
                                <div class="mlvel">
                                    <?php eh($attack->attack_name) ?> :
                                    <span style="color: #fcfcfc"><?php eh(ucfirst($attack->attack_type)) ?></span>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </a>
        <?php else :  ?>
        <a class="no-line" href="<?php eh(url('monster/view',array('monster_id' => $monster->monster_id))) ?>">
            <div class="inner-monster-content">
                <div class="monster-box">
                    <img src="/bootstrap/img/Monsters/monster<?php eh($monster->monster_id)?>-small.jpg">
                </div>
                <div class="tag">
                    <div class="mname">
                        <?php eh($monster->monster_name) ?>
                    </div>
                    <div class="mlvel">
                        Monster Level : <span style="color: #fcfcfc"><?php eh($monster->monster_level) ?></span>
                    </div>
                    <div class="mlvel">
                        Weakness : <span style="color: #fcfcfc"><?php eh(ucfirst($monster->monster_weakness)) ?></span>
                    </div>
                    <div class="mlvel">
                        Resistance : <span style="color: #fcfcfc"><?php eh(ucfirst($monster->monster_resist)) ?></span>
                    </div>
                </div>
                <div class="atk">
                    <?php foreach ($attacks as $attack) : ?>
                        <?php if ($attack->monster_name == $monster->monster_name) : ?>
                            <div class="mlvel">
                                <?php eh($attack->attack_name) ?> :
                                <span style="color: #fcfcfc"><?php eh(ucfirst($attack->attack_type)) ?></span>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
            </div>
        </a>
        <?php endif ?>
    <?php endforeach ?>
    <div class="pagination-box"><?php echo pagination($last_page, $page, Monster::CLICKABLE);; ?></div>
</div>
</form>
</div>
<?php endif ?>
</body>
