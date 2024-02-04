<?php

namespace App\Controller;

use App\Entity\Skills;
use App\Form\SkillsType;
use App\Repository\SkillsRepository;
use Doctrine\ORM\EntityManager;
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

    #[Route('/skills/new', name: 'skills_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $skills = new Skills();
        $formSkills = $this->createForm(SkillsType::class, $skills);

        $formSkills->handleRequest($request);

        if ($formSkills->isSubmitted() && $formSkills->isValid()) {
            $entityManager->persist($skills);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Le skill a été ajouté avec succès'
            );

            return $this->redirectToRoute('skills', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('/skills/new.html.twig', [
            'skills' => $skills,
            'formSkills' => $formSkills->createView(),
        ]);
    }

    #[Route('/skills/{id}/edit', name: 'skills_edit', methods: ['GET', 'POST'])]
    public function edit(Skills $skills, Request $request, EntityManagerInterface $entityManager): Response
    {
        $formSkills = $this->createForm(SkillsType::class, $skills);

        $formSkills->handleRequest($request);

        if ($formSkills->isSubmitted() && $formSkills->isValid()) {
            $entityManager->persist($skills);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Le skill a été modifié avec succès'
            );

            return $this->redirectToRoute('skills', [], Response::HTTP_SEE_OTHER);
        }
    
    return $this->render('skills/edit.html.twig', [
        'skills' => $skills,
        'formSkills' => $formSkills->createView(),
    ]);
    }

    #[Route('/skills/{id}/delete', name: 'skills_delete', methods: ['GET'])]
    public function delete(Skills $skills, EntityManagerInterface $entityManager): Response
    {
        if (!$skills) {
            $this->addFlash(
                'notice',
                'Le skill n\'existe pas'
            );
            return $this->redirectToRoute('skills', [], Response::HTTP_SEE_OTHER);
        }

        $entityManager->remove($skills);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Le skill a été supprimé avec succès'
        );

        return $this->redirectToRoute('skills', [], Response::HTTP_SEE_OTHER);
    }
}
