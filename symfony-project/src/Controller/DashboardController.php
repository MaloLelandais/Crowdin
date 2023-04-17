<?php

namespace App\Controller;

use App\Entity\UserLanguage;
use App\Repository\UserLanguageRepository;
use App\Repository\TraductionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DashboardController extends AbstractController
{
    public function __construct(UserLanguageRepository $UserLanguageRepo, TraductionRepository $TraductionRepo) 
    {
        $this->UserLanguageRepo = $UserLanguageRepo;
        $this->TraductionRepo = $TraductionRepo;
    }
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(Request $request): Response
    {
        $userLangs = $this->UserLanguageRepo->getUserLanguages($this->getUser());
        $userProjets = $this->TraductionRepo->getIdForUser($this->getUser());
        $projets=[];
        foreach ($userProjets as $projet)
        {
            array_push($projets, ["projet"=>$projet]);
        }
        $langue = new UserLanguage();
        $form = $this->createFormBuilder($langue)
                     ->add('language',LanguageType::class, ['attr' => ['class' => 'form-select']])
                     ->add('save', SubmitType::class, ['label' => 'Add Language', 'attr' => ['class' => 'btn btn-outline-dark mt-4']])
                     ->getForm();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form->handleRequest($request);

        if($form-> isSubmitted() && $form->isValid()){
            $langue->setUserId($this->getUser());
            $this->UserLanguageRepo->add($langue, true);
            return $this->redirect($request->getUri());
        }
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'user' => $this->getUser(),
            'formDash' => $form->createView(),
            'userLangs' => $userLangs,
            'userProjet' => $projets,
        ]);
    }
}