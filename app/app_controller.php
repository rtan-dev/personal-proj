<?php
class AppController extends Controller
{
    public $default_view_class = 'AppLayoutView';
    private $character = null;

    public function start()
    {
        if ($this->character !== null) {
            return $this->character;
        }

        try {
            $this->character = Character::get($_SESSION['username']);
        } catch(RecordNotFoundException $e) {
            $this->render('user/login');
        }

        return $this->character;
    }
}
