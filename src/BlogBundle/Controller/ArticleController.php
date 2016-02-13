<?php

namespace BlogBundle\Controller;
// error
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Entity\Article;
use BlogBundle\Form\Type\ArticleType;

class ArticleController extends Controller
{
	/**
	* @Route("/article", name="article")
	*/
    public function indexAction(request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('BlogBundle:Article')->findAll();
    
        return $this->render('BlogBundle:Article:index.html.twig', array(
                'articles' => $articles
        ));
    }

    /**
    * @Route("/article/{id}", name="show_article", requirements={"id" = "\d+"})
    */
    public function showAction(request $request, $id)
    {
        $article = $this->getDoctrine()->getRepository('BlogBundle:Article')->getById($id);
        
        return $this->render('BlogBundle:Article:show.html.twig', array(
                'Article' => $article,
        ));
    }

    /**
    * @Route("/article/categorie/{id}", name="show_article_category", requirements={"id" = "\d+"})
    */
    public function showcategoryAction(request $request, $id)
    {
        $category = $this->getDoctrine()->getRepository('BlogBundle:Category')->getById($id);

        $articleCategory = $this->getDoctrine()->getRepository('BlogBundle:Article')->findBy(array('category' => $category));
        return $this->render('BlogBundle:Article:index.html.twig', array(
                'articles' => $articleCategory,
        ));
    }
}