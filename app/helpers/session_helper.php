<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/9/13
 * Time: 9:13 PM
 * To change this template use File | Settings | File Templates.
 */

function check_session()
{
    if (!isset($_SESSION['username'])) {
        redirect('user/login');
    }
}

function is_logged_in()
{
    if (isset($_SESSION['username']) && isset($_SESSION['char_name'])) {
        redirect('character/character_main');
    }

    if (isset($_SESSION['username']) && !isset($_SESSION['char_name'])) {
        redirect('character/character_create');
    }
}

function is_char_exists()
{
    if (isset($_SESSION['username']) && !isset($_SESSION['char_name'])) {
        redirect('character/character_create');
    }
}

function is_battle_over()
{
    if (!isset($_SESSION['hunt'])) {
        redirect('character/character_main');
    }
}

function is_in_battle()
{
    if (isset($_SESSION['hunt']) && $_SESSION['m_id']) {
        redirect('hunt/hunt', array('id' => $_SESSION['hunt'], 'monster_id' => $_SESSION['m_id']));
    }
}

function is_logged_out()
{
    if (!isset($_SESSION['username'])) {
        redirect('user/login');
    }
}

function set_new_equip($equip_type)
{
    $equip_name = '';
    if (isset($_SESSION[$equip_type]) && !empty($_SESSION[$equip_type])) {
        $equip_name = $_SESSION[$equip_type];
        unset($_SESSION[$equip_type]);
    }
    return $equip_name;
}