<?php

namespace BlogBundle\Controller;
// error
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Entity\Article;
use BlogBundle\Form\Type\ArticleType;
use BlogBundle\Entity\Comment;
use BlogBundle\Form\Type\CommentType;
use Symfony\Component\HttpFoundation\Session\Session;

class ArticleController extends Controller
{
	/**
	* @Route("/article", name="article")
	*/
    public function indexAction(request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('BlogBundle:Article')->getAll();

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
        $session = new Session();
        $Comment = new Comment();
        $Comments = $this->getDoctrine()->getRepository('BlogBundle:Comment')->getByIdArticle($id);
        $formComment = $this->createForm(CommentType::class, $Comment);
        $formComment->handleRequest($request);

        if ($formComment->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $Comment->setArticle($article);
                $em->persist($Comment);
                $em->flush();
                $session->getFlashBag()->add('success', 'Le commentaire a été ajouté !');
        }
        return $this->render('BlogBundle:Article:show.html.twig', array(
                'formComment' => $formComment->createView(),
                'Article' => $article,
                'Comments' => $Comments
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