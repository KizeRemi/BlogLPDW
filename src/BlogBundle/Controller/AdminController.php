<?php

namespace BlogBundle\Controller;
// error
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Entity\Article;
use BlogBundle\Form\Type\ArticleType;
use BlogBundle\Entity\Category;
use BlogBundle\Form\Type\CategoryType;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends Controller
{
	/**
	* @Route("/admin", name="admin")
	*/
    public function indexAction(request $request)
    {
    	$article = new Article();
        $category = new Category();
        $session = new Session();
    	$formArticle = $this->createForm(ArticleType::class, $article);
        $formArticle->handleRequest($request);

        $formCategory = $this->createForm(CategoryType::class, $category);
        $formCategory->handleRequest($request);

        if ($formArticle->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                $session->getFlashBag()->add('success', 'L\'article a été ajouté !');
        }
        if ($formCategory->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($category);
                $em->flush();
                $session->getFlashBag()->add('success', 'La catégorie a été ajoutée !');
        }
        return $this->render('BlogBundle:Admin:index.html.twig', array(
                'formArticle' => $formArticle->createView(),
                'formCategory' => $formCategory->createView()
        ));
    }
    /**
    * @Route("/login", name="login")
    */
    public function loginAction( Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('BlogBundle:Admin:login.html.twig',array(
                'last_username' => $lastUsername,
                'error'         => $error,
        ));
    }
    /**
    * @Route("/login_check", name="login_check")
    */
    public function loginCheckAction( Request $request)
    {
        return $this->redirectToRoute('admin', array(), 301);   
    }
    /**
    * @Route("/logout", name="logout")
    */
    public function logoutAction( Request $request)
    {

    }
}