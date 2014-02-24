<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph Tan
 * Date: 11/7/13
 * Time: 10:48 AM
 * To change this template use File | Settings | File Templates.
 */

function hp_calculator($equip_level)
{
    if ($equip_level == 1) {
        return 0;
    }

    if ($equip_level <= 5) {
        return $equip_level * 10;
    }

    if($equip_level <= 7) {
        return $equip_level * 13;
    }

    if($equip_level <= 10) {
        return $equip_level * 16;
    }

    if($equip_level == 11) {
        return $equip_level * 22;
    }

    if($equip_level == 12) {
        return $equip_level * 28;
    }

    if($equip_level <= 14) {
        return $equip_level * 38;
    }

    if($equip_level > 14) {
        return $equip_level * 44;
    }
}

function get_gender($avatar)
{
    return ($avatar % 2) ? 'male' : 'female';
}

function random_damage($dmg)
{
    if ($dmg < 100) {
        $min_dmg = $dmg - 5;
    }
    elseif ($dmg >=100 && $dmg < 200) {
        $min_dmg = $dmg - 10;
    }
    else {
        $min_dmg = $dmg - 15;
    }
    return rand($min_dmg, $dmg);
}

function get_element($elem, $equip_type)
{
    switch ($elem) {
        case 'physical':
            if ($equip_type == 'weapon') {
                return '/bootstrap/img/Elements/physical-small';
            }

            return '/bootstrap/img/Elements/physical-armor';
        case 'physical2':
            return '/bootstrap/img/Elements/physical2';
        case 'fire':
            return '/bootstrap/img/Elements/fire';
        case 'fire2':
            return '/bootstrap/img/Elements/fire2-small';
        case 'ice':
            return '/bootstrap/img/Elements/ice';
        case 'ice2':
            return '/bootstrap/img/Elements/ice2';
        case 'water':
            return '/bootstrap/img/Elements/water';
        case 'thunder':
            return '/bootstrap/img/Elements/thunder';
        case 'elemental':
            return '/bootstrap/img/Elements/elemental';
        case 'dragon':
            return '/bootstrap/img/Elements/dragon';
        case 'crit':
            return '/bootstrap/img/Elements/crit';
        default:
            break;
    }
}