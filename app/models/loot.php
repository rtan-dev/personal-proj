<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/8/14
 * Time: 7:35 PM
 */
class Loot extends Item
{
    /**
     * Gets all loots dropped by a monster.
     * @param $monster_id
     * @return array
     */
    public static function getLoots($monster_id)
    {
        $db = DB::conn();

        $rows = $db->rows('SELECT * FROM item WHERE monster_id = ?', array($monster_id));

        $loots = array();

        if ($rows) {
            foreach ($rows as $row) {
                $loots[] = new Loot($row);
            }
        }

        return new self(array('loots' => $loots));
    }
    
    public function randomizeLoots()
    {
        $drops = array();

        for ($i = 0; $i < self::MAX_LOOT_COUNT; $i++) {
            $rand = rand(1, 100);
            if ($rand >= 1 && $rand <= 42) {
                $drops[] = $this->loots[0];
            } elseif ($rand > 42 && $rand <= 73) {
                $drops[] = $this->loots[1];
            } elseif ($rand > 73 && $rand <= 92) {
                $drops[] = $this->loots[2];
            } elseif ($rand > 92) {
                $drops[] = $this->loots[3];
            }
        }

        return $drops;
    }
}