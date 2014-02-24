<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 12/1/13
 * Time: 10:15 PM
 * To change this template use File | Settings | File Templates.
 */

class Craft extends AppModel
{
    const MAX_PAGE = 3;
    const CLICKABLE = 2;

    public static function getCraftRequirements(Character $character, $equip_name)
    {
        $db = DB::conn();
        $craft_requirements = array();
        $rows = $db->rows(
            'SELECT e.equip_name, i.item_id, i.item_name, i.item_type, c.quantity FROM craft c INNER JOIN equipment e
            ON c.equip_id = e.equip_id INNER JOIN item i ON c.item_id = i.item_id WHERE e.equip_name = ?',
            array($equip_name)
        );

        if (!$rows) {
            throw new RecordNotFoundException('Record not found');
        }

        foreach ($rows as $row) {
            $row['character'] = $character;
            $craft_requirements[] = new CraftMaterial($row);
        }
        return $craft_requirements;
    }

    public static function getAll($page, $level, $type, $equips = array())
    {
        $db = DB::conn();

        $offset = ($page - 1) * Craft::MAX_PAGE;
        $equipment = array();

        $rows = $db->rows(
            'SELECT * FROM equipment WHERE equip_level <= ? AND equip_type = ? AND equip_id NOT IN (?) AND monster_id
            ORDER BY equip_level LIMIT '.Craft::MAX_PAGE.' OFFSET '.$offset,
            array($level, $type, $equips)
        );

        if (!$rows) {
            throw new RecordNotFoundException('Record not found');
        }

        foreach ($rows as $row) {
            $equipment[] = new self($row);
        }

        return $equipment;
    }
}