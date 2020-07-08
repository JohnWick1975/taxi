<?php

namespace App\Views;

use App\App;

class Navigation extends \Core\View
{

    public function __construct($data = [])
    {
        parent::__construct($data);

        $this->addLink('left', '/index', 'Home');
        $this->addLink('left', '/feedback', 'Comments');

        $user = App::$session->getUser();
        if ($user) {
            $this->addLink('right', '/logout', "Logout");

        } else {
            $this->addLink('right', '/login', 'Login');
            $this->addLink('right', '/register', 'Register');
        }

    }

    public function addLink($section, $url, $title)
    {
        $link = ['url' => $url, 'title' => $title];

        if ($_SERVER['REQUEST_URI'] === $link['url']) {
            $link['active'] = true;
        }

        $this->data[$section][] = $link;
    }


    public function render(string $template_path = ROOT . '/app/templates/navigation.tpl.php')
    {
        return parent::render($template_path);
    }

}
