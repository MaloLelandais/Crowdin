<?php

namespace App\Controller;

use App\Repository\TraductionRepository;
use App\Entity\Traduction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DemandeController extends AbstractController
{

    public function __construct(TraductionRepository $TraductionRepo) 
    {
        $this->TraductionRepo = $TraductionRepo;
    }


    #[Route('/demande', name: 'app_demande')]
    public function index(Request $request): Response
    {
        $demande = new Traduction();
        $form2 = $this->createFormBuilder($demande)
            ->add('project', TextareaType::class, ['label' => 'Your project','attr' => ['class' => 'form-control']])
            ->add('lang_from',LanguageType::class, ['label' => 'Your language','attr' => ['class' => 'form-select']])
            ->add('lang_to',LanguageType::class, ['label' => 'Which langue to translate','attr' => ['class' => 'form-select']])
            ->add('save', SubmitType::class, ['label' => 'Add project', 'attr' => ['class' => 'btn btn-outline-dark mt-4']])
            ->getForm();

            $form2->handleRequest($request);

            if($form2-> isSubmitted() && $form2->isValid()){
                $demande->setUser($this->getUser());
                $this->TraductionRepo->add($demande, true);
                return $this->redirect($request->getUri());
            }

        return $this->render('demande/index.html.twig', [
            'controller_name' => 'DemandeController',
            'formDemande' => $form2->createView(),
        ]);
    }
}
