<?php
namespace App\Controller;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\PropretySearch;
use App\Form\ArticleType;
use App\Form\CategoryType;
use App\Form\PropretySearchType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @method getDoctrine()
 */
class IndexController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(ArticleRepository $articleRepository,Request $request,EntityManagerInterface $entityManager): Response
    {

            $articles= $articleRepository->findAll();


        return $this->render('/index.html.twig', ['articles' => $articles]);
    }

    #[Route('/article/save', name: 'saveArticle')]
    public function saveArticle(EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $article->setNom('Article 1');
        $article->setPrix('1000');
        $entityManager->persist($article);
        $entityManager->flush();
        return new Response('Article enregistré avec id ' . $article->getId());

    }

    #[Route('/article/new', name: 'newArticle', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $entityManager->persist($article);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('articles/new.html.twig', ['form' => $form->createView()]);

    }

    #[Route('/article/{id}', name: 'article_show')]
    public function show($id, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($id);
        if (!$article) {
            throw $this->createNotFoundException('L\'article n\'existe pas');
        }
        return $this->render('articles/show.html.twig', ['article' => $article]);
    }

    #[Route('/article/edit/{id}', name: 'edit_article', methods: ['GET', 'POST'])]
    public function edit($id, Request $request, ArticleRepository $articleRepository, EntityManagerInterface $entityManager): Response
    {
        $article = $articleRepository->find($id);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('articles/edit.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/article/delete/{id}', name: 'delete_article', methods: ['GET', 'DELETE'])]
    public function delete($id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager): Response
    {
        $article = $articleRepository->find($id);
        $entityManager->remove($article);
        $entityManager->flush(); //excute la requete avec le DB
        $response = new Response();
        $response->send();
        return $this->redirectToRoute('home');
    }

    #[Route('/category/new', name: 'newCategory', methods: ['GET', 'POST'])]
    public function newCategory(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('articles/newCategory.html.twig', ['form' => $form->createView()]);

    }


}
