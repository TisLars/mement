<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Triangle;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $triangle = new Triangle();
        $result = 'Fill in 3 sides';

        $form = $this->createFormBuilder($triangle)
            ->add('a', TextType::class)
            ->add('b', TextType::class)
            ->add('c', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create triangle'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$triangle` variable has also been updated
            $triangle = $form->getData();

            // init sides
            $a = $triangle->getA();
            $b = $triangle->getB();
            $c = $triangle->getC();

            if (($a + $b > $c) && ($a + $c > $b) && ($b + $c > $a))
                $result = 'This is a triangle';
            else
                $result = 'This is NOT a triangle';

            $em = $this->getDoctrine()->getManager();
            $em->persist($triangle);
            $em->flush();
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
            'result' => $result,
        ));
    }
}
