<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Writer;
use App\Entity\Category;
use App\Entity\Language;
use App\Entity\Status;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    #[Route('/books/listing', name: 'books_listing')]
    public function bookListing(ManagerRegistry $doctrine): Response
    {
        $books = $doctrine->getRepository(Book::class)->findAll();

        return $this->render('book/listing.html.twig', [
            'books' => $books,
        ]);
    }
    #[Route('/book/add', name: 'book_add')]
    public function addBook(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        // creates a book object and initializes some data for this example
        $book = new Book();

        $form = $this->createFormBuilder($book)
            ->add('title', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('writerid', EntityType::class, [
                // looks for choices from this entity
                'class' => Writer::class,
                // uses the User.username property as the visible option string
                'choice_label' => function($writer) {
                    return $writer -> getFirstname(). ' ' . $writer -> getLastname();
                },
                'attr' => ['class' => 'form-control',
                ]])
            ->add('plot', TextareaType::class, ['attr' => ['class' => 'form-control']])
            ->add('languageid', EntityType::class, [
                // looks for choices from this entity
                'class' => Language::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control',
            ]])
            ->add('publicationDate', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('categoryid', EntityType::class, [
                // looks for choices from this entity
                'class' => Category::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control',
                ]])
            ->add('statusid', EntityType::class, [
                     // looks for choices from this entity
                'class' => Status::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control',
                ]])
            ->add('save', SubmitType::class, ['attr' => ['class' => 'btn btn-primary']])
            ->getForm();

            $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $book = $form->getData();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($book);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->redirectToRoute('books_listing');
        }


            return $this->renderForm('book/add.html.twig', [
                'form' => $form,
            ]); 
            
    }
    #[Route('/book/delete/{id}', name: 'book_delete')]
    public function deleteBook(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);
        if ($book -> getStatusid() -> getName() !== "Emprunté" && $book -> getStatusid() -> getName() !== "Réservé") {
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('books_listing');
    }

    #[Route('/book/infos/{id}', name: 'book_infos')]
    public function getBook(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);
        

        return $this->render('book/infos.html.twig', [
            'book' => $book,
        ]);
    }
       
}
