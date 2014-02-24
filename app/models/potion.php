<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/8/14
 * Time: 7:34 PM
 */
class Potion extends Item
{
    public static function getPotions($char_id)
    {
        $db = DB::conn();

        $rows = $db->rows(
            'SELECT a.quantity, b.* FROM inventory a INNER JOIN item b
            ON a.item_id = b.item_id
            WHERE a.item_type = ?
            AND a.char_id = ?
            ORDER BY b.item_id',
            array(self::ITEM_TYPE_USEABLE, $char_id)
        );

        $potions = array();
        if ($rows) {
            foreach ($rows as $row) {
                $potions[] = new self($row);
            }
        }
        return $potions;
    }
}