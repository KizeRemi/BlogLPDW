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
use BlogBundle\Entity\Tag;
use BlogBundle\Form\Type\TagType;
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
        $tag = new Tag();
        $session = new Session();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $article->setUser($user);
        
    	$formArticle = $this->createForm(ArticleType::class, $article);
        $formArticle->handleRequest($request);

        $formCategory = $this->createForm(CategoryType::class, $category);
        $formCategory->handleRequest($request);

        $formTag = $this->createForm(TagType::class, $tag);
        $formTag->handleRequest($request);

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
        if ($formTag->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                $em->flush();
                $session->getFlashBag()->add('success', 'Le tag a été ajoutée !');
        }
        return $this->render('BlogBundle:Admin:index.html.twig', array(
                'formArticle' => $formArticle->createView(),
                'formTag' => $formTag->createView(),
                'formCategory' => $formCategory->createView()
        ));
    }

    /**
    * @Route("/admin/article/{id}", name="delete_article", requirements={"id" = "\d+"})
    */
    public function delete_articleAction(request $request, $id)
    {
        $session = new Session();
        $em = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()->getRepository('BlogBundle:Article')->getById($id);

        $em->remove($article);
        $em->flush();
        $session->getFlashBag()->add('success', 'L\'article a été supprimé !');

        return $this->redirectToRoute('article');
    }
    /**
    * @Route("/admin/article/edit/{id}", name="edit_article", requirements={"id" = "\d+"})
    */
    public function showAction(request $request, $id)
    {
        $session = new Session();
        $article = $this->getDoctrine()->getRepository('BlogBundle:Article')->getById($id);
        $formArticle = $this->createForm(ArticleType::class, $article);
        $formArticle->handleRequest($request);

        if ($formArticle->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                $session->getFlashBag()->add('success', 'L\'article a été modifié !');
        }
        return $this->render('BlogBundle:Admin:edit.html.twig', array(
                'formArticle' => $formArticle->createView()
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