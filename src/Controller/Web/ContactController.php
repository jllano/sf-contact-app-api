<?php

namespace App\Controller\Web;

use App\Entity\Contact;
use App\Form\Type\ContactType;
use App\Service\ContactManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact", name="contact")
 */
class ContactController extends AbstractController
{

    /**
     * @var ContactManager $contactManager
     */
    private $contactManager;

    /**
     * @param ContactManager $contactManager
     * @param FormInterface $formFactory
     */
    public function __construct(ContactManager $contactManager)
    {
        $this->contactManager = $contactManager;
    }

    /**
     * @Route("", name="_post_contact", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        dump($request);

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {



            if ($form->isValid()){
                $this->contactManager->create($form->getData());
            }
        }

        return $this->render('contact/index.html.twig',
            [
            'form' => $form->createView()
            ]
        );

    }

}
