<?php

namespace Pixellary\InhouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Pixellary\InhouseBundle\Entity\Client;
use Pixellary\InhouseBundle\Form\ClientType;
use Pixellary\InhouseBundle\Entity\Task;
use Pixellary\InhouseBundle\Form\TaskType;
use Pixellary\InhouseBundle\Entity\Project;
use Pixellary\InhouseBundle\Form\ProjectType;

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

    public function reportingAction()
    {
        return $this->render('PixellaryInhouseBundle:Default:reporting.html.twig');
    }

    public function projectsExtendedAction()
    {
        return $this->render('PixellaryInhouseBundle:Default:projects.html.twig');
    }

    public function scheduleAction()
    {
        return $this->render('PixellaryInhouseBundle:Default:schedule.html.twig');
    }




    public function taskListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tasks = $em->getRepository('PixellaryInhouseBundle:Task')->findBy(array(), array('id' => 'DESC'));

        //$taskProject = $tasks->getProject()->getTitle();

        return $this->render('PixellaryInhouseBundle:Default:taskList.html.twig', array( 'tasks'=> $tasks ));
    }

    public function taskFormAction()
    {
        $request = $this->getRequest();

        $task = new Task();
        
        $task->setCreated(new \DateTime());

        $form = $this->createForm(new TaskType(), $task);

        if ($request->getMethod() == 'POST') {

            $form->bind($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();

                $em->persist($task);

                $tasks = $em->getRepository('PixellaryInhouseBundle:Task')->findAll();

                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'SUCCESS!');

                return $this->redirect($this->generateUrl('pixellary_inhouse_taskList'));

            }

        }

        return $this->render('PixellaryInhouseBundle:Default:taskForm.html.twig',array('form' => $form->createView()) );
    }

    public function clientListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('PixellaryInhouseBundle:Client')->findBy(array(), array('id' => 'DESC'));

        return $this->render('PixellaryInhouseBundle:Default:clientList.html.twig', array( 'clients'=> $clients ));
    }

    public function clientFormAction()
    {
        $request = $this->getRequest();

        $client = new Client();

        $form = $this->createForm(new ClientType(), $client);

        if ($request->getMethod() == 'POST') {

            $form->bind($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();

                $em->persist($client);

                $clients = $em->getRepository('PixellaryInhouseBundle:Client')->findAll();

                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'SUCCESS!');

                return $this->redirect($this->generateUrl('pixellary_inhouse_clientList'));

            }

        }

        return $this->render('PixellaryInhouseBundle:Default:clientForm.html.twig',array('form' => $form->createView()) );
    }


    public function projectListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('PixellaryInhouseBundle:Project')->findBy(array(), array('id' => 'DESC'));

        return $this->render('PixellaryInhouseBundle:Default:projectList.html.twig', array( 'projects'=> $projects ));
    }

    public function projectFormAction()
    {
        $request = $this->getRequest();
        
        $project = new Project();

        $form = $this->createForm(new ProjectType(), $project);

        if ($request->getMethod() == 'POST') {

            $form->bind($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                
                $project->upload();
                
                $em->persist($project);

                $projects = $em->getRepository('PixellaryInhouseBundle:Project')->findAll();

                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'SUCCESS!');

                return $this->redirect($this->generateUrl('pixellary_inhouse_projectList'));

            }

        }

        return $this->render('PixellaryInhouseBundle:Default:projectForm.html.twig',array('form' => $form->createView()) );
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

