<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/8/14
 * Time: 7:39 PM
 */
class RankService
{
    private $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function getKillDeathRatio()
    {
        return Rank::getKillDeathRatio();
    }

    public function getTotalScore()
    {
        return Rank::getTotalScore();
    }
}