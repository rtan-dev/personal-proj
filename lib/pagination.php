<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 5/31/14
 * Time: 7:48 AM
 */
class Pagination
{
    public $last_page;
    public $page;
    public $max_page;
    public $page_string = '';

    public function __construct($last_page, $page)
    {
        $this->last_page = $last_page;
        $this->page = $page;
    }

    public function getPage()
    {
        if (!$this->page) {
            return 1;
        }
        return ($this->page > $this->last_page) ? $this->last_page : $this->page;
    }

    public function setPages()
    {
        if (!$this->page || $this->page < 1) {
            $this->page = 1;
        }

        if ($this->last_page < 1) {
            $this->last_page = 1;
        } elseif ($this->page > $this->last_page) {
            $this->page = $this->last_page;
        }
    }

    public function paginate($num_link, $page_link = 'page')
    {
        $this->setPages();
        if ($this->last_page != 1) {
            $this->setPreviousLink($page_link);
            $this->setLeftLinks($num_link, $page_link);
            $this->setCurrentPage();
            $this->setRightLinks($num_link, $page_link);
            $this->setNextLink($page_link);
        }
        return $this->page_string;
    }

    public function setPreviousLink($page_link)
    {
        if ($this->page > 1) {
            $this->page_string .= '<a class="btn-small no-line" href = "'.url('', array($page_link => $this->page - 1)).'">«</a>';
        }
    }

    public function setNextLink($page_link)
    {
        if ($this->page != $this->last_page) {
            $this->page_string .= '<a class="btn-small no-line" href = "'.url('', array($page_link => $this->page + 1)).'">«</a>';
        }
    }

    public function setCurrentPage()
    {
        $this->page_string .= ''.$this->page;
    }

    public function setLeftLinks($num_link, $page_link)
    {
        for ($i = $this->page - $num_link; $i < $this->page; $i++) {
            if ($i > 0) {
                $this->page_string .= '<a class="btn-small no-line" href = "'.url('', array($page_link => $i)).'">'.$i.'</a>';
            }
        }
    }

    public function setRightLinks($num_link, $page_link)
    {
        for ($i = $this->page + 1; $i <= $this->last_page; $i++) {
            $this->page_string .= '<a class="btn-small no-line" href = "'.url('', array($page_link => $i)).'">'.$i.'</a>';
            if ($i >= $this->page + $num_link) {
                break;
            }
        }
    }
}