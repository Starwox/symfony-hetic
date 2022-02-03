<?php
/**
 * Created by PhpStorm.
 * User: starwox
 * Date: 03/02/2022
 * Time: 04:35
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{

    /**
     * @Route("/user/new", name="home")
     */
    public function createUser()
    {


    }
}