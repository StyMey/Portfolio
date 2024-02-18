<?php

namespace App\Controller\Admin;

use App\Entity\Skills;
use App\Form\SkillsType;
use App\Repository\SkillsRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/skills', name: 'skills_')]
class SkillsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SkillsRepository $repository): Response
    {
        $skillss = $repository->findAll();

        return $this->render('admin/skills/index.html.twig', [
            'skillss' => $skillss
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
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

            return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/skills/new.html.twig', [
            'skills' => $skills,
            'formSkills' => $formSkills->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
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

            return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
        }
    
    return $this->render('admin/skills/edit.html.twig', [
        'skills' => $skills,
        'formSkills' => $formSkills->createView(),
    ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['GET'])]
    public function delete(Skills $skills, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($skills);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Le skill a été supprimé avec succès'
        );

        return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
    }
}
