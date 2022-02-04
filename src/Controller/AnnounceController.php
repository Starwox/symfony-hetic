<?php
/**
 * Created by PhpStorm.
 * User: starwox
 * Date: 01/02/2022
 * Time: 16:39
 */

namespace App\Controller;

use App\Entity\Announce;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        $announces = $this->em->getRepository(Announce::class)->findAll();

        return $this->render('announce/home.html.twig', [
            'announces' => $announces,
        ]);
    }
}