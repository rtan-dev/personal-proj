<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/21/14
 * Time: 11:23 PM
 */
class QuestController extends AppController
{
    public function index()
    {
        $character = Character::get($_SESSION['username']);
        $quest_service = $character->getServiceLocator()->getQuestService();
        $this->set(get_defined_vars());
    }
}