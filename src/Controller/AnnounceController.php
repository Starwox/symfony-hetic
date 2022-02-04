<?php
/**
 * Created by PhpStorm.
 * User: starwox
 * Date: 01/02/2022
 * Time: 16:39
 */

namespace App\Controller;

use App\Entity\Announce;
use App\Form\Type\AnnounceType;
use App\Form\Type\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AnnounceController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {

        return $this->render('announce/home.html.twig');
    }

    /**
     * @Route("/buy/{title}", name="get_all_announces", defaults={"title": ""})
     */
    public function getAnnounces(Request $request, string $title)
    {
        $announce = new Announce();
        $searchForm = $this->createForm(SearchType::class, $announce);
        if (isset($title))
        {
            $announces = $this->em->getRepository(Announce::class)->searchByTitle($title);

        } else {
            $announces = $this->em->getRepository(Announce::class)->findAll();

        }

        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $announce = $searchForm->getData();

            return $this->redirectToRoute('get_all_announces', ['title' => $announce->getTitle()]);

        }

        return $this->renderForm('announce/buy/home.html.twig', [
            'announces' => $announces,
            'searchForm' => $searchForm
        ]);
    }

    /**
     * @Route("/sell", name="new_announce")
     */
    public function newAnnounce(Request $request)
    {
        $announce = new Announce();
        $form = $this->createForm(AnnounceType::class, $announce);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $announce = $form->getData();

            $this->em->persist($announce);
            $this->em->flush();


            return $this->redirectToRoute('get_all_announces');
        }


        return $this->renderForm('announce/sell/new.html.twig', [
            'form' => $form
        ]);
    }
}