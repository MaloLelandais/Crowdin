<?php

namespace App\Controller;

use App\Repository\TraductionRepository;
use App\Repository\UserLanguageRepository;
use App\Entity\Traduction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Doctrine\Persistence\ManagerRegistry;

class TraductionController extends AbstractController
{

    public function __construct(TraductionRepository $TraductionRepo, UserLanguageRepository $UserLanguageRepo) 
    {
        $this->UserLanguageRepo = $UserLanguageRepo;
        $this->TraductionRepo = $TraductionRepo;
    }

    #[Route('/traduction', name: 'app_traduction')]
    public function index(Request $request): Response
    {
        $userLangs = $this->UserLanguageRepo->getUserLanguages($this->getUser());
        $translations = $this->TraductionRepo->getTraductionForUser($userLangs);
        $projects = [];
        foreach ($translations as $translation) {
            $form = $this->createFormBuilder($translation)
            ->add('result', TextareaType::class, ['label' => 'Your translation','attr' => ['class' => 'form-control ']])
            ->add('save', SubmitType::class, ['label' => 'Add translation', 'attr' => ['class' => 'btn btn-outline-dark mt-4']])
            ->getForm();

            $form->handleRequest($request);

            if($form-> isSubmitted() && $form->isValid()){
                // $this->TraductionRepo->find();
                $translation->setUser($this->getUser());
                $this->TraductionRepo->add($translation, true);
                return $this->redirect($request->getUri());
            }
            array_push($projects, ["translation"=>$translation, "formView" => $form->createView()]);
        }

        return $this->render('traduction/index.html.twig', [
            'user' => $this->getUser(),
            'controller_name' => 'TraductionController',
            'forms' => $projects,
            'Projet' => $translations,
        ]);
    }
}
