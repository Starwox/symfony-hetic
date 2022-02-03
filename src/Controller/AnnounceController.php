<?php
/**
 * Created by PhpStorm.
 * User: starwox
 * Date: 01/02/2022
 * Time: 16:39
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AnnounceController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function number()
    {

        return new Response(
            '<html><body>Lucky number</body></html>'
        );
    }
}