<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/7/13
 * Time: 12:31 PM
 * To change this template use File | Settings | File Templates.
 */

class Monster extends AppModel
{
    const MIN_LEVEL = 1;
    const MAX_MONSTERS = 6;
    const RAGE = 40;
    const CLICKABLE = 4;

    /**
     * Retrieves all monsters in the database
     * based on the characters maximum level
     * equip existing in his/her inventory.
     * @param $max_level
     * @param $page
     * @return array
     */
    public static function getAll($max_level,$page)
    {
        $db = DB::conn();
        $offset = ($page - 1) * self::MAX_MONSTERS;

        $rows = $db->rows(
            'SELECT * FROM monster WHERE monster_level >= 1 AND monster_level <= ?
            ORDER BY monster_level
            LIMIT '.self::MAX_MONSTERS. ' OFFSET '.$offset,
            array($max_level));

        $monsters = array();

        if ($rows) {
            foreach ($rows as $row) {
                $monsters[] = new Monster($row);
            }
        }

        return $monsters;
    }

    /**
     * Retrives attacks of all monsters
     */
    public static function getAttacks()
    {
        $db = DB::conn();

        $rows = $db->rows(
            'SELECT m.monster_name, a.attack_name, a.attack_type
             FROM attack a INNER JOIN monster m
             ON a.monster_id = m.monster_id;'
        );

        $attacks = array();
        if ($rows) {
            foreach ($rows as $row) {
                $attacks[] = new Monster($row);
            }
        }

        return $attacks;
    }

    /**
     * @param $monster_id
     * @param Character $character
     * @return Monster
     */
    public static function get($monster_id, Character $character = null)
    {
        $db = DB::conn();

        $row = $db->row('SELECT * FROM monster WHERE monster_id = ?', array($monster_id));

        if ($row) {
            $row['character'] = $character;
            return new self($row);
        }
    }

    public function getDamage()
    {
        $norm_dmg = $this->attack_dmg - $this->character->char_armor;
        $res_dmg = floor(($this->attack_dmg / 1.2) - $this->character->char_armor);
        $weak_dmg = floor(($this->attack_dmg / 1.5) - $this->character->char_armor);

        switch ($this->armor->equip_elem) {
            case $this->attack_type:
                if ($this->attack_type == 'physical' && $this->armor->equip_elem != 'physical2') {
                    return ($norm_dmg < 0) ? 0 : $norm_dmg;
                } else {
                    return ($res_dmg < 0) ? 0 : $res_dmg;
                }
            case 'ice2':
                if ($this->attack_type == 'ice') {
                    return ($weak_dmg < 0) ? 0 : $weak_dmg;
                }
            case 'fire2':
                if ($this->attack_type == 'fire') {
                    return ($weak_dmg < 0) ? 0 : $weak_dmg;
                }
            case 'physical2':
                if ($this->attack_type == 'physical') {
                    return ($weak_dmg < 0) ? 0 : $weak_dmg;
                }
            case 'elemental':
                return ($res_dmg < 0) ? 0 : $res_dmg;
            default:
                return ($norm_dmg < 0) ? 0 : $norm_dmg;
        }
    }

    public function getID()
    {
        return $this->monster_id;
    }

    public function getRageDamage()
    {
        return floor($this->getDamage($this->armor->equip_elem) * 1.5);
    }

    /**
     * @return Monster
     * @throws RecordNotFoundException
     */
    public function getRandomMonsterAttack(Character $character, Armor $armor)
    {
        $db = DB::conn();
        $rows = $db->rows(
            'SELECT a.* FROM attack a INNER JOIN monster m
            ON a.monster_id = m.monster_id WHERE a.monster_id = ?
            ORDER BY a.attack_dmg',
            array($this->monster_id)
        );

        if (!$rows) {
            throw new RecordNotFoundException('Record not found');
        }

        shuffle($rows);
        $rows[0]['armor'] = $armor;
        $rows[0]['character'] = $character;
        return new self($rows[0]);
    }

    public function is_enraged($current_hp)
    {
        return (floor(($current_hp / $this->monster_max_hp) * 100) < self::RAGE) ? true : false;
    }
}