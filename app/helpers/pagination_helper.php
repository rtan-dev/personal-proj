<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 1/31/14
 * Time: 3:44 PM
 */

function page_validate($page, $last_page)
{
    if (!$page) {
        return 1;
    }

    return ($page > $last_page) ? $last_page : $page;
}

function pagination($last_page, $pagenum, $clickable, $page = 'page')
{
    $pagination_ctrl = "";

    if ($last_page < 1) {
        $last_page = 1;
    }

    if ($pagenum < 1) {
        $pagenum = 1;
    }
    elseif ($pagenum > $last_page) {
        $pagenum = $last_page;
    }

    if ($last_page != 1) {
        if ($pagenum > 1) {
            $previous = $pagenum - 1;
            $pagination_ctrl .= '<a class="btn-small no-line" href = "'.url('', array($page => $previous)).'">«</a>';
        }

        for($i = $pagenum - $clickable; $i < $pagenum; $i++) {
            if ($i > 0) {
                $pagination_ctrl .= '<a class="btn-small no-line" href = "'.url('', array($page => $i)).'">'.$i.'</a>';
            }
        }

        $pagination_ctrl .= ''.$pagenum;

        for ($i = $pagenum + 1; $i <= $last_page; $i++) {
            $pagination_ctrl .= '<a class="btn-small no-line" href = "'.url('', array($page => $i)).'">'.$i.'</a>';
            if ($i >= $pagenum + $clickable) {
                break;
            }
        }

        if ($pagenum != $last_page) {
            $next = $pagenum + 1;
            $pagination_ctrl .= '<a class="btn-small no-line" href = "'.url('', array($page => $next)).'">»</a>';
        }
    }

    return $pagination_ctrl;
}

