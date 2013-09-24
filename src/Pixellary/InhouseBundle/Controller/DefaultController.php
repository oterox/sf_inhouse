<?php

namespace Pixellary\InhouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //return $this->render('PixellaryInhouseBundle:Default:index.html.twig', array('name' => $name));
        return $this->render('PixellaryInhouseBundle:Default:index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('PixellaryInhouseBundle:Default:about.html.twig');
    }

    public function boardAction()
    {
        return $this->render('PixellaryInhouseBundle:Default:board.html.twig');
    }

    public function scheduleAction()
    {
        return $this->render('PixellaryInhouseBundle:Default:schedule.html.twig');
    }

    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'PixellaryInhouseBundle:Default:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }

}

