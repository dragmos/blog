<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $posts = [];
        // $posts[] = [
        //     'title' => 'titulo',
        //     'img' => 'https://assets-global.website-files.com/6009ec8cda7f305645c9d91b/60107f24db0303590fb92c4b_6002086f72b72727f901e44d_pl-media.jpeg',
        //     'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        // ];
        // $posts[] = [
        //     'title' => 'titulo 2',
        //     'img' => 'https://assets-global.website-files.com/6009ec8cda7f305645c9d91b/60107f2471dfb182d3a749b1_6002086f72b727fc4501e44c_provincial-spirits-wine.jpeg',
        //     'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        // ];
        return $this->render('plain_html/web/index.html.twig', [
            'posts' => $posts
        ]);
        // return $this->render('web/index.html.twig', [
            // 'controller_name' => 'WebController',
        // ]);
    }
    
    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        return $this->render('plain_html/login/index.html.twig');
        
        // return $this->render('web/index.html.twig', [
        //     'controller_name' => 'WebController',
        // ]);
    }
    
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(): Response
    {
        return $this->render('plain_html/admin/index.html.twig');
        
        // return $this->render('web/index.html.twig', [
        //     'controller_name' => 'WebController',
        // ]);
    }
}
