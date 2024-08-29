<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\TestType;
use App\Service\TestService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    private TestService $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    #[Route('/', name: 'get_test')]
    public function getTests(EntityManagerInterface $entityManager, Request $request): Response
    {
        $questions = $entityManager->getRepository(Question::class)->findAll();

        $form = $this->createForm(TestType::class, null, ['questions' => $questions]);
        $form->handleRequest($request);

        $result = [];

        if ($form->isSubmitted()) {
            $this->testService->validateTestForm($questions, $result, $form);

            if ($form->isValid()) {
                $resultEntity = $this->testService->storeTestResults($result, $entityManager);
                return $this->redirectToRoute('show_result', ['id' => $resultEntity->getId()]);
            }
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
            'title' => 'Test',
        ]);
    }
}
