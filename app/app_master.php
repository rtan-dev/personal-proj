<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/15/14
 * Time: 8:36 AM
 */
abstract class AppMaster
{
    static $data = array();

    public static function get($id)
    {
        if (!isset(static::$data[$id])) {
            throw new MasterRecordNotFoundException('[' . get_called_class() . '] ' . 'no record found with id: ' . (($id)? $id : 'null'));
        }
        $row = static::$data[$id];
        $row['id'] = $id;
        return $row;
    }

    public static function row($conditions = array())
    {
        foreach (static::$data as $row) {
            if (!array_diff_assoc($conditions, $row)) {
                return $row;
            }
        }

        throw new MasterRecordConditionNotFoundException(get_called_class(), $conditions);
    }

    public static function rows($conditions = array())
    {
        $rows = array();
        foreach (static::$data as $k => $row) {
            if (!array_diff_assoc($conditions, $row)) {
                $rows[$k] = $row;
            }
        }
        if (!$rows) {
            throw new MasterRecordConditionNotFoundException(get_called_class(), $conditions);
        }
        return $rows;
    }

    public static function getLastId()
    {
        $a = array_keys(static::$data);
        return array_pop($a);
    }

    /**
     * 配列から、key (value), key (value)のような文字列を返す
     * @param array $conditions
     * @return string
     */
    public static function getConditionsAsString($conditions = array())
    {
        if (!$conditions) {
            return 'condition is empty.';
        }

        $string = '';
        foreach($conditions as $key=>$value) {
            $string .= "$key ($value),";
        }

        return $string;
    }
}