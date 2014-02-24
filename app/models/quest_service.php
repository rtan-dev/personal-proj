<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/21/14
 * Time: 11:23 PM
 */
class QuestService
{
    private $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }
}