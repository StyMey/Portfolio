<?php

namespace App\Controller;

use App\Entity\Skills;
use App\Form\SkillsType;
use App\Repository\SkillsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SkillsController extends AbstractController
{
    #[Route('/skills', name: 'skills')]
    public function index(SkillsRepository $repository): Response
    {
        $skillss = $repository->findAll();

        return $this->render('skills/index.html.twig', [
            'skillss' => $skillss
        ]);
    }

    #[Route('/skills/new', methods: ['GET', 'POST'], name: 'skills_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $skills = new Skills();
        $formSkills = $this->createForm(SkillsType::class, $skills);

        $formSkills->handleRequest($request);

        if ($formSkills->isSubmitted() && $formSkills->isValid()) {
            $entityManager->persist($skills);
            $entityManager->flush();

            return $this->redirectToRoute('skills', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('/skills/new.html.twig', [
            'skills' => $skills,
            'formSkills' => $formSkills->createView(),
        ]);
    }
}
