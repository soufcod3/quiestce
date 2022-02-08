<?php

namespace App\Controller;

use App\Entity\Clues;
use App\Entity\Question;
use App\Entity\Wilder;
use App\Repository\WilderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Session $session): Response
    {
        // Initializing the score to 0 in the session
        if (null == $session->get('score')) {
            $session->set('score', 0);
        }

        $score = $session->get('score');

        return $this->render('game/index.html.twig', [
            'score' => $score,
        ]);
    }


    /**
     * @Route("/play", name="play")
     */
    public function play(WilderRepository $wilderRepository, Session $session): Response
    {
        if (isset($_POST['answer'])) {

            // If the answer is right
            if ($_POST['answer'] == $session->get('name')) {
                // Setting a new score (+100 pts)
                $session->set('score', $session->get('score') + 100);
                return $this->redirectToRoute('success', [], Response::HTTP_SEE_OTHER);
            }
            // If not, the score drops by 30 pts
            $session->set('score', $session->get('score') - 30);
            return $this->redirectToRoute('play', [], Response::HTTP_SEE_OTHER);
        } else {
            $wilder = $wilderRepository->findOneById(rand(1, 3));
            $session->set('name', $wilder->getName());
        }

        return $this->render('game/layout.html.twig', [
            'wilder' => $wilder,
            'score' => $session->get('score'),
        ]);
    }


    /**
     * @Route("/play/success", name="success")
     */
    public function success(WilderRepository $wilderRepository, Session $session)
    {
        $score = $session->get('score');
        $wilder = $wilderRepository->findOneByName($session->get('name'));

        return $this->render('game/play/success.html.twig', [
            'wilder' => $wilder,
            'score' => $score,
        ]);
    }

    /**
     * @Route("/play/{question}", name="answer")
     */
    public function answer(WilderRepository $wilderRepository, Question $question, Session $session, Request $request): Response
    {
        $wilder = $wilderRepository->findOneByName($session->get('name'));

        // Avoiding score drop at each page refresh
        // Returns true if refreshed
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

        if (!$pageWasRefreshed) {
            $session->set('score', $session->get('score') - 10);
        }

        if (isset($_POST['answer'])) {
            // If the answer is right
            if ($_POST['answer'] == $session->get('name')) {
                // Setting a new score (+100 pts)
                $session->set('score', $session->get('score') + 100);
                return $this->redirectToRoute('success', [], Response::HTTP_SEE_OTHER);
            }
            // If not, the score drops by 30 pts
            $session->set('score', $session->get('score') - 30);
        }

        return $this->render('game/play/answer.html.twig', [
            'wilder' => $wilder,
            'question' => $question,
            'score' => $session->get('score'),
        ]);
    }

    /**
     * @Route("/play/clue/{clue}", name="clue")
     */
    public function clue(WilderRepository $wilderRepository, Clues $clue, Session $session): Response
    {
        $wilder = $wilderRepository->findOneByName($this->get('session')->get('name'));

        // Avoiding score drop at each page refresh
        // Returns true if refreshed
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        if (!$pageWasRefreshed) {
            $session->set('score', $session->get('score') - 20);
        }

        if (isset($_POST['answer'])) {
            // If the answer is right
            if ($_POST['answer'] == $session->get('name')) {
                // Setting a new score (+100 pts)
                $session->set('score', $session->get('score') + 100);
                return $this->redirectToRoute('success', [], Response::HTTP_SEE_OTHER);
            }
            // If not, the score drops by 30 pts
            $session->set('score', $session->get('score') - 30);
        }

        return $this->render('game/play/clue.html.twig', [
            'wilder' => $wilder,
            'clue' => $clue,
            'score' => $session->get('score'),
        ]);
    }

    /**
     * @Route("/reset", name="reset_score")
     */
    public function reset(Request $request, Session $session)
    {
        if ($this->isCsrfTokenValid('reset', $request->request->get('_token'))) {
            $session->set('score', 0);
        }

        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }
}
