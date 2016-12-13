<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Form\CalcType;
use AppBundle\Entity\Calculator;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/new.html.twig');
    }

    /**
     * @Route("/number", name="number")
     */
    public function numberAction(Request $request)
    {
        $calc = new Calculator();
        $a = 0;
        $b = 0;
        $result = 'null';

        $form = $this->createForm(CalcType::class, $calc);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $a = $form->get('a')->getData();
            $b = $form->get('b')->getData();
            
            $result = $a + $b;
        }

        return $this->render(
            'calculator/calculate.html.twig',
            array(
                'form' => $form->createView(),
                'result' => $result)
        );
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            // $password = $this->get('security.password_encoder')
            //     ->encodePassword($user, $user->getPassword());
            // $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
