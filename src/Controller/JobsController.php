<?php

namespace App\Controller;

use App\Entity\Job;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobsController extends AbstractController
{

    private $repoJob;

    public function  __construct(JobRepository $repoJob)
    {
        $this->repoJob = $repoJob;
    }


    /**
     * @Route("/jobs", name="jobs")
     */
    public function index(): Response
    {
        $jobs = $this->repoJob->findBy(array(), array('id'=>'desc'));

        return $this->render('jobs/index.html.twig', [
            'jobs' => $jobs
        ]);
    }

    /**
     * @Route("/jobs/{slug}", name="job_view")
     */
    public function job_show(Job $job): Response
    {
        if(!$job){
            return $this->redirectToRoute('home');
        }

        return $this->render('jobs/show.html.twig', [
            'job' => $job
        ]);
    }

}
