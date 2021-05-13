<?php

namespace App\Controller;

use App\Repository\MembreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoireController extends AbstractController
{

    private $repoMembre;

    public function  __construct(MembreRepository $repoMembre)
    {
        $this->repoMembre = $repoMembre;
    }


    /**
     * @Route("/histoire", name="histoire")
     */
    public function index(): Response
    {

        $membres = $this->repoMembre->findBy([], ['id'=>'asc']);


        return $this->render('histoire/index.html.twig', [
            'membres' => $membres,
        ]);
    }
}
