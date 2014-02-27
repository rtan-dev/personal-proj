<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/2/13
 * Time: 10:57 AM
 * To change this template use File | Settings | File Templates.
 */

class Character extends AppModel
{
    const DEFAULT_WEAPON = 1;
    const DEFAULT_ARMOR = 2;
    const DEFAULT_HP = 100;
    const CREATE_OK = 'create_success';

    private $damage;
    private $armor;
    private $hp;
    private $new_zeny;

    public $avatar;
    public $validation = array(
        'char_name' => array(
            'length' => array(
                'validate_between', 3, 15
            ),
            'valid' => array(
                'validate_format'
            )
        )
    );

    /**
     * Creates character. Automatically
     * creates default armor and weapon and
     * 3 Herbs to character inventory.
     * @throws ValidationException
     */
    public function create($user_name)
    {
        $this->validation['char_name']['valid'][] = $this->getName();
        if (!$this->validate() || $this->isDuplicate()) {
            throw new ValidationException('Invalid Character Information');
        }

        $user_id = User::getUserID($user_name);

        $db = DB::conn();
        $params = array(
            'user_id' => $user_id,
            'char_name' => $this->getName(),
            'avatar' => $this->avatar,
            'char_hp' => self::DEFAULT_HP,
            'char_max_hp' => self::DEFAULT_HP
        );
        $db->begin();
        try {
            $db->insert('characters', $params);
            $this->char_id = $db->lastInsertId();
            $service = $this->getServiceLocator();

            // third parameter will automatically equip the weapon
            $service->getEquipService()->create(self::DEFAULT_WEAPON, Equip::TYPE_WEAPON, Equip::SET_EQUIP);
            $service->getEquipService()->create(self::DEFAULT_ARMOR, Equip::TYPE_ARMOR, Equip::SET_EQUIP);

            // automatically create 5 herbs in inventory
            Item::create(Item::SET_HERB, Item::ITEM_TYPE_USEABLE, $this->getID(), Item::HERB_COUNT);

            $weapon = $service->getEquipService()->get(self::DEFAULT_WEAPON);
            $armor = $service->getEquipService()->get(self::DEFAULT_ARMOR);
            $this->updateDmgArmor($weapon->getStat(), $armor->getStat());
            $db->commit();
        } catch(Exception $e) {
            $db->rollback();
        }
    }

    /**
     * @param $username
     * @return Character
     * @throws RecordNotFoundException
     */
    public static function get($username)
    {
        $db = DB::conn();

        $row = $db->row(
            'SELECT a.* FROM characters a INNER JOIN user b
             ON a.user_id = b.user_id
             WHERE b.username=?',
            array($username)
        );

        if (!$row) {
            throw new RecordNotFoundException('Character not found');
        }

        return new self($row);
    }

    public function setDamage($damage)
    {
        $this->damage = $damage;
        return $this;
    }

    public function setArmor($armor)
    {
        $this->armor = $armor;
        return $this;
    }

    public function setHP($hp)
    {
        $this->hp = $hp;
        return $this;
    }

    public function setZeny($zeny)
    {
        $this->new_zeny = $zeny;
        return $this;
    }

    public function getDamage()
    {
        return $this->damage;
    }

    public function getArmor()
    {
        return $this->armor;
    }

    public function getHp()
    {
        return $this->hp;
    }

    public function getZeny()
    {
        return $this->new_zeny;
    }

    public function getID()
    {
        return $this->char_id;
    }

    public function getName()
    {
        return $this->char_name;
    }

    public function getServiceLocator($service = null)
    {
        return new ServiceLocator($service, $this);
    }

    public function isDuplicate()
    {
        $db = DB::conn();

        $row = $db->row('SELECT char_name FROM characters WHERE char_name=?', array($this->char_name));

        return $row;
    }

    public static function isInBattle($char_id)
    {
        $db = DB::conn();

        $row = $db->row(
            'SELECT c.in_battle, b.monster_id FROM characters c INNER JOIN battle b
            ON c.in_battle = b.battle_id WHERE c.char_id = ? LIMIT 1',
            array($char_id)
        );

        if ($row) {
            return new self($row);
        }
    }

    /**
     * Updates the characters damage and armor.
     * @param $dmg
     * @param $armor
     * @param $charid
     */
    public function updateDmgArmor($dmg, $armor)
    {
        $db = DB::conn();
        $params = array(
            'char_dmg' => $dmg,
            'char_armor' => $armor,
        );

        $db->update('characters', $params, array('char_id' => $this->getID()));
    }

    public function updateArmor()
    {
        $db = DB::conn();
        $params = array(
            'char_armor' => $this->getArmor(),
            'char_hp' => $this->getHp(),
            'char_max_hp' => $this->getHp()
        );
        $db->update('characters', $params, array('char_id' => $this->char_id));
    }

    public function updateDamage()
    {
        $db = DB::conn();
        $db->update('characters', array('char_dmg' => $this->getDamage()), array('char_id' => $this->char_id));
    }

    public function updateZeny()
    {
        $db = DB::conn();
        $db->update('characters', array('zeny' => $this->getZeny()), array('char_id' => $this->char_id));
    }
}