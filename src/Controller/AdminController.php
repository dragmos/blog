<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Post;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(Session $session): Response
    {
        if ($session->get('login') != 'true') return $this->redirect('login');
        
        $entityManager = $this->getDoctrine()->getManager();
        
        $posts = $entityManager->getRepository(Post::class)->findAll();
        
        return $this->render('plain_html/admin/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/post", name="create_post", methods={"POST"})
     */
    public function createPost(Request $request, Session $session): Response
    {
        if ($session->get('login') != 'true') return $this->redirect('login');
        
        $entityManager = $this->getDoctrine()->getManager();
        
        $title = $request->get('title');
        $content = $request->get('content');
        $imgUrl = $request->get('imgUrl');

        if (
            trim($title) != '' && 
            trim($imgUrl) != '' && 
            trim($content) != ''
        ) {
            $newPost = new Post();
            $newPost->setTitle($title);
            $newPost->setImgUrl($imgUrl);
            $newPost->setContent($content);
            $entityManager->persist($newPost);
            $entityManager->flush();
        }
        
        return $this->redirect('admin');
    }
    
    /**
     * @Route("/post", name="delete_post", methods={"DELETE"})
     */
    public function deletePost(Request $request, Session $session): Response
    {
        if ($session->get('login') != 'true') return $this->redirect('login');
        
        $entityManager = $this->getDoctrine()->getManager();
        
        $postId = $request->get('id');
        
        $post = $entityManager->getRepository(Post::class)->find($postId);
        
        $entityManager->remove($post);
        
        $entityManager->flush();
        
        return $this->redirect('admin');
    }
    
    /**
     * @Route("/login", name="login", methods={"GET", "POST"})
     */
    public function login(Request $request, Session $session): Response
    {
        if ($session->get('login') == 'true') return $this->redirect('admin');
        
        // si alguien lo ve... login con fines didácticos XD
        if ($request->getMethod() == "POST") {
            $user = $request->get('user');
            $password = $request->get('password');
            
            if ($user == 'admin' && $password == 'pass') {
                $session->set('login', 'true');
                return $this->redirect('admin');
            }
        }
        
        return $this->render('plain_html/login/index.html.twig');
    }
    
    /**
     * @Route("/logout", name="logout", methods={"POST"})
     */
    public function logout(Session $session): Response
    {
        $session->set('login', 'false');
        return $this->redirect('login');
    }
}
