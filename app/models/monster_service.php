<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/8/14
 * Time: 7:33 PM
 */
class MonsterService
{
    private $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function getAllMonsters($max_level, $page)
    {
        return Monster::getAll($max_level, $page);
    }

    public function getLastPage($max_level)
    {
        $db = DB::conn();
        $row_count = $db->value('SELECT COUNT(*) FROM monster WHERE monster_level >= ? AND monster_level <=? LIMIT 1',
            array(Monster::MIN_LEVEL, $max_level));

        return ceil($row_count / Monster::MAX_MONSTERS);
    }

    public function getMonster($monster_id)
    {
        return Monster::get($monster_id);
    }

    public function getMonsterAttacks()
    {
        return Monster::getAttacks();
    }
}