<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/11/13
 * Time: 10:50 AM
 * To change this template use File | Settings | File Templates.
 */

class Rank extends AppModel
{
    const DEFAULT_KILL = 1;
    const NO_KILLS = 0;

    public static function getKillDeathRatio()
    {
        $db = DB::conn();

        $rows = $db->rows(
            'SELECT char_id, char_name, monster_kills, player_deaths
            FROM characters
            WHERE monster_kills <> ?
            ORDER BY monster_kills DESC, player_deaths
            LIMIT 10',
            array(self::NO_KILLS)
        );

        $rankings = array();
        if ($rows) {
            foreach ($rows as $row) {
                $rankings[] = new Rank($row);
            }
        }

        return $rankings;
    }

    public static function getTotalScore()
    {
        $db = DB::conn();

        $rows = $db->rows(
            'SELECT char_id, char_name, total_score
            FROM characters
            WHERE total_score <> ?
            ORDER BY total_score DESC LIMIT 10',
            array(self::NO_KILLS)
        );

        $score = array();
        if ($rows) {
            foreach ($rows as $row) {
                $score[] = new Rank($row);
            }
        }

        return $score;
    }

    public static function getCharInfo($char_id)
    {
        $db = DB::conn();

        $row = $db->row('SELECT * FROM characters WHERE char_id = ?', array($char_id));

        return new Character($row);
    }
}