<?php 

namespace App\Controllers;

class Blog 
{
    public function indexAction()
    {
        \Core\View::renderTemplate('blog',[],null);
    }
}

?>