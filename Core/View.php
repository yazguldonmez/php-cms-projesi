<?php

namespace Core;

class View
{
    public $content;
    public function load($viewName, $data = [])
    {
        ob_start();
        extract($data);
        require BASEDIR . '/App/View/' . $viewName . '.php';//App/View içinde load a gelen argümana .php ekleyerek döndür
        $this->content = ob_get_contents();//ob_start ve clean arasına yazılan tüm verileri kaydedip content değişkenine aktarıyoruz
        ob_clean();
        return $this->content;
    }
}
