<?php

namespace warehouse;

class Pagination
{
    
    public int $count_pages = 1;
    public int $current_page = 1;
    public string $uri = '';
    public int $mid_size = 3;
    public int $all_pages = 10;
    
    
    public function __construct(public int $page = 1, public int $per_page = 1, public int $total = 1)
    {
        $this->count_pages = $this->getCountPages();
        $this->current_page = $this->getCurrentPage();
        $this->mid_size = $this->getMidSize();
        $this->uri = $this->getParams();
    }
    
    
    private function getCountPages():int
    {
        return ceil($this->total / $this->per_page) ?: 1;
    }
    
    
    private function getCurrentPage():int
    {
        if ($this->page < 1)
        {
            $this->page = 1;
        }
        if ($this->page > $this->count_pages)
        {
            $this->page = $this->count_pages;
        }
        return $this->page;
    }
    
    
    public function getStart():int
    {
        return ($this->current_page-1)*$this->per_page;
    }
    
    
    private function getParams():string
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?',$url);
        
        $uri = $url[0];
        if (isset($url[1]) && $url[1] !== '')
        {
            $uri .= '?';
            $params = explode('&',$url[1]);
            foreach ($params as $param)
            {
                if (!str_contains($param, 'page='))
                {
                    $uri .= $param.'&';
                }
            }
        }
        return $uri;
    }
    
    
    public function getHtml():string
    {
        $back = '';
        $forward = '';
        $start_page = '';
        $end_page = '';
        $pages_left = '';
        $pages_right = '';
        
        if ($this->current_page > 1)
        {
            $back = "<li class='page-item mx-1'>
                        <a href='".$this->getLink($this->current_page - 1)."' class='page-link bg-dark'>&lt;</a>
                     </li>";
        }
        if ($this->current_page < $this->count_pages)
        {
            $forward = "<li class='page-item mx-1'>
                        <a href='".$this->getLink($this->current_page + 1)."' class='page-link bg-dark'>&gt;</a>
                     </li>";
        }
        if ($this->current_page > ($this->mid_size + 1))
        {
            $start_page = "<li class='page-item mx-1'>
                        <a href='".$this->getLink(1)."' class='page-link bg-dark'>&laquo;</a>
                     </li>";
        }
        
        if ($this->current_page < ($this->count_pages - $this->mid_size))
        {
            $end_page = "<li class='page-item mx-1'>
                        <a href='".$this->getLink($this->count_pages)."' class='page-link bg-dark'>&raquo;</a>
                     </li>";
        }
        
        for ($i = $this->mid_size; $i > 0; $i--)
        {
            if (($this->current_page - $i) > 0)
            {
                $pages_left .= "<li class='page-item mx-1'>
                        <a href='".$this->getLink($this->current_page - $i)."' class='page-link bg-dark'>".($this->current_page - $i)."</a>
                     </li>";
            }
        }
        
        for ($i = 1; $i <= $this->mid_size; $i++)
        {
            if (($this->current_page + $i) <= $this->count_pages)
            {
                $pages_right .= "<li class='page-item mx-1'>
                        <a href='".$this->getLink($this->current_page + $i)."' class='page-link bg-dark'>".($this->current_page + $i)."</a>
                     </li>";
            }
        }
        
        return '<nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">'
                  .$start_page.$back.$pages_left.
                  ' <li class="page-item active mx-1"><a class="page-link">'.$this->current_page.'</a></li>'
                  .$pages_right.$forward.$end_page.
                  '</ul>
                </nav>';
    }
    
    
    private function getLink($page):string
    {
        // if ($page == 1)
        // {
        //     return rtrim($this->uri,'?&');
        // }
        
        if (str_contains($this->uri,'&') || str_contains($this->uri,'?'))
        {
            return $this->uri.'page='.$page;
        }
        else
        {
            return $this->uri.'?page='.$page;
        }
    }
    
    private function getMidSize():int
    {
        return ($this->count_pages <= $this->all_pages) ? $this->count_pages : $this->mid_size;
    }
    
    public function __toString():string
    {
        return $this->getHtml();
    }
    
    
    
    
    
    
    
}