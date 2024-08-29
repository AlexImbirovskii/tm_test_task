<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Result;
use App\Service\ResultService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ResultController extends AbstractController
{
    private ResultService $resultService;

    public function __construct(ResultService $resultService)
    {
        $this->resultService = $resultService;
    }


    #[Route('/results', name: 'get_results')]
    public function getTests(
        EntityManagerInterface $entityManager,
        Request $request,
        PaginatorInterface $paginator,
    ): Response
    {
        $query = $entityManager->getRepository(Result::class)->createQueryBuilder('r')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('results/index.html.twig', [
            'pagination' => $pagination,
            'title' => 'Results'
        ]);
    }

    #[Route('/results/{id}', name: 'show_result')]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        $result = $entityManager->getRepository(Result::class)->find($id);

        if (!$result) {
            throw $this->createNotFoundException();
        }

        $resultData = $this->resultService->getResultData($result);
        $questions = $entityManager->getRepository(Question::class)->findAll();

        return $this->render('results/show.html.twig', [
            'result' => $result,
            'questions' => $questions,
            'resultData' => $resultData,
            'title' => "Result #$id"
        ]);
    }
}
