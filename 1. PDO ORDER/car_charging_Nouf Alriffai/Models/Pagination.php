<?php

class Pagination
{

    protected $total_pages, $search;

    public function __construct($total_pages, $search = '')
    {
        $this->total_pages = $total_pages;
        $this->search = $search ?? '';
    }

    public function paginationLink()
    {
        $pagLink = "<ul class='pagination'>";
        for ($i = 1; $i <= $this->total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link' href='list.php?page=" . $i . "&query=" . $this->search ."'>" . $i . "</a></li>";
        }
        return $pagLink . "</ul>";
    }
}
