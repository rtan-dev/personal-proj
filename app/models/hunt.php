<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/7/13
 * Time: 4:03 PM
 * To change this template use File | Settings | File Templates.
 */

class Hunt extends AppModel
{
    public $is_critical = false;

    const WIN = 'Win';
    const LOSE = 'Lose';

    /**
     * Computations for character damage are done
     * in this method.
     * @param $char_dmg
     * @param $weapon_elem
     * @param Monster $monster
     * @return float
     */
    public function computeCharDmg($char_dmg, $weapon_elem, Monster $monster){
        $this->is_critical = false;

        $str_dmg = floor(($char_dmg * 1.3) - $monster->monster_armor);
        $weak_dmg = floor(($char_dmg - $monster->monster_resist_value) - $monster->monster_armor);
        $crit_dmg = floor(($char_dmg * 1.8) - $monster->monster_armor);
        $sp_dmg = floor(($char_dmg * 1.4) - $monster->monster_armor);
        $norm_dmg = $char_dmg - $monster->monster_armor;

        switch ($weapon_elem) {
            case $monster->monster_weakness:
                return ($str_dmg < 0) ? 0 : $str_dmg;
            case $monster->monster_resist:
                return ($weak_dmg < 0) ? 0 : $weak_dmg;
            case 'crit':
                $rand = rand(1,100);
                if ($rand <= 20) {
                    $this->is_critical = true;
                    return $crit_dmg;
                } elseif ($monster->monster_resist == 'physical') {
                    return ($weak_dmg < 0) ? 0 : $weak_dmg;
                }
                return $norm_dmg;
            case 'elemental':
                return $sp_dmg;
            default:
                return ($norm_dmg < 0) ? 0 : $norm_dmg;
        }
    }

    public function deleteLogs($char_id)
    {
        $db = DB::conn();

        $db->query('DELETE FROM battle WHERE char_id = ?', array($char_id));
    }

    /**
     * @param $battle_id
     * @param $monster_id
     * @return Hunt
     * @throws RecordNotFoundException
     */
    public static function getBattle($battle_id, $monster_id)
    {
        $db = DB::conn();

        $row = $db->row('SELECT * FROM battle WHERE battle_id = ? AND monster_id = ?', array($battle_id, $monster_id));

        if (!$row) {
            throw new RecordNotFoundException('Record not found');
        }
        return new self($row);
    }

    /**
     * Game over function.
     * @param Character $char
     * @param Monster $monster
     */
    public function loseBattle(Character $char, Monster $monster)
    {
        $db = DB::conn();
        $player_deaths = $char->player_deaths + 1; // increase player death by 1
        $this->deleteLogs($char->char_id);
        $db->update(
            'characters',
            array('player_deaths' => $player_deaths, 'in_battle' => 0),
            array('char_id' => $char->char_id)
        );

    }

    /**
     * @param $char_dmg
     * @param $monster_dmg
     * @param Monster $monster
     * @param Character $char
     * @param $atk_name
     * @return string
     */
    public function monsterBattle($char_dmg, $monster_dmg, Monster $monster, Character $char, $atk_name)
    {
        $db = DB::conn();

        // prevents HP from dropping below 0.
        $new_char_hp = (($char->char_hp - $monster_dmg) > 0) ? ($char->char_hp - $monster_dmg) : 0;
        $new_monster_hp = (($this->mon_hp - $char_dmg) > 0) ? ($this->mon_hp - $char_dmg) : 0;

        // if character hp is 0, player loses
        if (!$new_char_hp) {
            $this->resetHealth($char);
            $this->loseBattle($char, $monster);
            return self::LOSE;
        }
        // if monster hp is 0, player wins
        if (!$new_monster_hp) {
            $this->winBattle($monster, $char);
            return self::WIN;
        }

        try {
            $db->begin();
            $db->update('characters',
                array('char_hp' => $new_char_hp, 'char_max_hp' => $char->char_max_hp),
                array('char_id' => $char->char_id)
            );
            $db->update(
                'battle',
                array('mon_hp' => $new_monster_hp),
                array('battle_id' => $this->battle_id)
            );
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }

        $_SESSION['char'] = $char_dmg;
        $_SESSION['mon'] = $monster_dmg;

        $this->updateMessage($monster->monster_name, $char_dmg, $monster_dmg, $atk_name);
    }

    /**
     * Resets character health
     * @param Character $char
     */
    public function resetHealth(Character $char)
    {
        $db = DB::conn();
        $db->update(
            'characters',
            array('char_hp' => $char->char_max_hp),
            array('char_id' => $char->char_id)
        );
    }

    public function setAnimation()
    {
        if (isset($_SESSION['char'])) {
            $this->char_anim = isset($_SESSION['heal']) ? $_SESSION['heal'] : $_SESSION['char'];
            $this->mon_anim = isset($_SESSION['mon']) ? $_SESSION['mon'] : null;
            unset($_SESSION['char']);
            unset($_SESSION['mon']);
            unset($_SESSION['heal']);
        }
    }

    /**
     * Updates the message log.
     * @param $monster_name
     * @param $char_dmg
     * @param $monster_dmg
     * @param $atk_name
     * @param Hunt $hunt
     */
    public function updateMessage($monster_name, $char_dmg, $monster_dmg, $atk_name)
    {
        $db = DB::conn();

        $char_log = $this->battle_log;
        $mon_log = $this->monster_log;
        if ($this->is_critical) {
            $char_log = "Your attack was a critical hit! $monster_name took <b>$char_dmg</b> damage!<br>" . $char_log;
            $mon_log = "$monster_name attacked you with $atk_name for $monster_dmg damage!<br>" . $mon_log;
        } else {
            $char_log = "You attacked $monster_name for $char_dmg damage!<br>" . $char_log;
            $mon_log = "$monster_name attacked you with $atk_name for $monster_dmg damage!<br>" . $mon_log;
        }
        $db->update(
            'battle',
            array('battle_log' => $char_log, 'monster_log' => $mon_log),
            array('battle_id' => $this->battle_id)
        );
    }

    /**
     * Function for item used in battle.
     * @param $item_id
     * @param $item_name
     * @param $use_value
     * @param $item_count
     * @param Character $char
     * @param Hunt $hunt
     */
    public function useItem($item_id, $item_name, $use_value, $item_count, Character $char)
    {
        $heal = floor(($use_value / 100) * $char->char_max_hp);
        $hp = $heal + $char->char_hp; // compute heal amount

        if ($hp > $char->char_max_hp) {
            $hp = $char->char_max_hp;
        }

        $db = DB::conn();
        $message = $this->battle_log;
        $message = "You used $item_name.<br>" . $message;
        $item_count--;
        $upd_item = array(
            'item_id' => $item_id,
            'item_type' => Item::ITEM_TYPE_USEABLE,
            'char_id' => $char->char_id
        );
        $_SESSION['char'] = $heal;
        $_SESSION['heal'] = $heal;

        try {
            $db->begin();
            $db->update(
                'battle',
                array('battle_log' => $message),
                array('battle_id' => $this->battle_id)
            );

            $db->update('characters', array('char_hp' => $hp), array('char_id' => $char->char_id));
            $db->update('inventory',
                array('quantity' => $item_count),
                $upd_item
            );
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }


    /**
     * Function for character victory.
     * Updates character monster kills
     * and zeny.
     * @param Monster $monster
     * @param Character $char
     * @param Hunt $hunt
     * @return bool
     */
    public function winBattle(Monster $monster, Character $char)
    {
        $db = DB::conn();
        $monster_kills = $char->monster_kills + 1; // increase monster kill count by 1
        $kill_score = $char->total_score + ($monster->monster_level * 3); // kill score = current score + mon level * 3
        $this->resetHealth($char);
        $this->deleteLogs($char->char_id);
        $params = array(
            'monster_kills' => $monster_kills,
            'total_score' => $kill_score,
            'zeny' => $char->zeny + $monster->monster_zeny,
            'in_battle' => 0
        );

        $db->update('characters', $params, array('char_id' => $char->char_id));
    }
}