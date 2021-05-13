<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Media;
use App\Form\SearchType;
use App\Repository\MediaRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MediasController extends AbstractController
{

    private $repoMedia;

    public function  __construct(MediaRepository $repoMedia)
    {
        $this->repoMedia = $repoMedia;
    }


    /**
     * @Route("/medias", name="medias")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        // appelle tous les articles pour les afficher sur la page medias par id descendant
        $medias = $this->repoMedia->findBy([], ['id'=>'desc']);


        /* ---------------------------------------------------------------------------------------------*/
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $medias = $this->repoMedia->findWithSearch($search);
        }
        else
        {
            $medias = $this->repoMedia->findBy([], ['id'=>'desc']);
        }
        /* ---------------------------------------------------------------------------------------------*/


        $medias = $paginator->paginate(
            $medias, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );



        return $this->render('medias/index.html.twig', [
            'medias' => $medias,
            'form' => $form->createView(),
        ]);

    }


    /**
     * @Route("/medias/{slug}", name="media_view")
     */
    public function media_show(Media $media): Response
    {
        if(!$media){
            return $this->redirectToRoute('home');
        }

        return $this->render('medias/show.html.twig', [
            'media' => $media,
        ]);
    }


}
