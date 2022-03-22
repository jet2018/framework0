<?php

namespace Jet\Framework\Views;

class View
{
    function Entry(){
        return 'root';
    }

    function page($page)
    {
        return $this->show($page);
    }

    function show($page){
        echo $this->Entry(). " ". $page;
    }
}