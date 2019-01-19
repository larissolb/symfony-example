<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Country;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
    /**
     * @Route("/article/add", name="article")
     */
    public function add()
    {
        // получение из бд
        $entityManager = $this->getDoctrine()->getManager();
        $country = $entityManager
            ->getRepository(Country::class)
            ->find(1);

        $article = new Article();
        $article->setTitle("Путешествие");
        $article->setDescription("Путешествие по Дании");
        $article->setCountry($country);

        // добавление в базу
        $entityManager->persist($article);
        $entityManager->flush();

        // вернуть строку
//        return new Response("Hello");

        // вернуть html c данными
        return $this->render('article/index.html.twig', [
            'controller_name' => $article->getTitle(),
        ]);
    }
}
