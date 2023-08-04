<?php

namespace Core;
//BaseController ve BaseModel strarterdan extends ediyor Controllers ta BaseControllerdan extends ediyor.
class Starter
{
    public $router;
    public $db;
    public $request;
    public $view;
    public function __construct()
    {
        $this->router = new \Bramus\Router\Router(); //tıklayıp yola gidersen namespace Bramus\Router; classı Router olana gittiğini
        $this->db = new Database(); 
        $this->request = new Request(); 
        $this->view = new View(); 
    }
}
