<?php

class ViewController
{

    public function home()
    {
        return $this->render('user/notifications.html.twig', []);
    }

}

?>