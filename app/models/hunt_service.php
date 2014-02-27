<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/8/14
 * Time: 7:32 PM
 */
class HuntService
{
    private $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function battleStart(Monster $monster)
    {
        $db = DB::conn();

        $params = array(
            'char_id' => $this->character->char_id,
            'monster_id' => $monster->monster_id,
            'mon_hp' => $monster->monster_hp,
            'mon_name' => $monster->monster_name
        );
        try {
            $db->begin();
            $db->insert('battle', $params);
            $db->update('characters', array('in_battle' => $this->getBattleId()), array('char_id' => $this->character->char_id));
            $db->commit();
        } catch(Exception $e) {
            $db->rollback();
        }

        return $this->getBattleId();
    }

    public function getBattleId()
    {
        $db = DB::conn();

        return $db->value('SELECT battle_id FROM battle WHERE char_id = ?', array($this->character->char_id));
    }
}