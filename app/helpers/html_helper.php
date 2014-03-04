<?php

function eh($string)
{
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
}

function readable_text($s)
{
    $s = htmlspecialchars($s, ENT_QUOTES);
    $s = nl2br($s);
    return $s;
}


function redirect($url = null, $params = null)
{
    header('Location: ' . url($url, $params));
    die();
}

/**
 * Randomizes the monster's attacks.
 * @param array $attack
 * @return mixed
 */
function random_attack($attack = array())
{
    $count = count($attack);

    $rand = rand(1,100);

    if ($count == 3) {
        if ($rand >= 1 && $rand <= 35) {
            return $attack[0];
        }

        if ($rand > 35 && $rand <= 70) {
            return $attack[1];
        }

        if ($rand > 70 && $rand <= 100) {
            return $attack[2];
        }
    } else {
        if ($rand >= 1 && $rand <= 35) {
            return $attack[0];
        }

        if ($rand > 35 && $rand <= 65) {
            return $attack[1];
        }

        if ($rand > 65 && $rand <= 85) {
            return $attack[2];
        }

        if ($rand > 85 && $rand <= 100 ) {
            return $attack[3];
        }
    }
}

function hp($hp, $max)
{
    return floor(($hp / $max) * 100);
}

function convert_element($element)
{
    switch ($element) {
        case 'physical2':
            return 'Physical';
        case 'ice2':
            return 'Ice';
        case 'fire2':
            return 'Fire';
        default:
            return $element;
    }
}