<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Book;
use App\Entity\Writer;
use App\Entity\Category;
use App\Entity\Language;
use App\Entity\Borrowing;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    #[Route('/books/listing', name: 'books_listing')]
    public function bookListing(ManagerRegistry $doctrine, Request $request): Response
    {
        $data = [];
        $formFilter = $this->createFormBuilder()
        ->add('writerid', EntityType::class,[
            'label' => 'Ecrivain :',
            'class' => Writer::class,
            'required' => false,
            'choice_label' => function ($writer) {
                return $writer->getFirstname() . ' ' . $writer->getLastname();
            },'attr' => ['class' => 'form-control my-2']])
        ->add('languageid', EntityType::class,[
            'label' => 'Langage :',
            'class' => Language::class,
            'required' => false,
            'choice_label' => 'name',
            'attr' => ['class' => 'form-control my-2']])
        ->add('categoryid', EntityType::class,[
            'label' => 'Catégorie :',
            'required' => false,
            'class' => Category::class,
            'choice_label' => 'name',
            'attr' => ['class' => 'form-control my-2']])
        ->add('availability', ChoiceType::class,[
            'label' => 'Disponibilité :',
            'required' => false,
            'choices'  => [
                'Disponible' => 'Disponible',
                'Emprunté'     => 'Emprunté',
                'Indisponible' => 'out',
            ],
            'attr' => ['class' => 'form-control my-2']
        ])
        ->add('save', SubmitType::class, ['label' => 'Filtrer','attr' => ['class' => 'btn mt-3']])
        ->getForm();

        $formFilter->handleRequest($request);

    if ($formFilter->isSubmitted() && $formFilter->isValid()) {
        
        $data = $formFilter->getData();
        if ($data['availability']==='Disponible') {
            $data['availability'] = [0=>'full', 1=>'middle'];
        } else if ($data['availability']==='Emprunté') {
            $data['availability'] = [0=>'out', 1=>'middle'];
        }
        $data = array_filter($data);
    }

        $books=$doctrine->getRepository(Book::class)->findBy($data);
        return $this->renderForm('book/listing.html.twig', [
            'books' => $books,
            'formFilter' => $formFilter,
        ]);
    }
    #[Route('/book/add', name: 'book_add')]
    public function addBook(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        // creates a book object and initializes some data for this example
        $book = new Book();

        $form = $this->createFormBuilder($book)
            ->add('title', TextType::class, ['label' => 'Titre :', 'attr' => ['class' => 'form-control  text-center']])
            ->add('writerid', EntityType::class, [
                // looks for choices from this entity
                'class' => Writer::class,
                // uses the User.username property as the visible option string
                'choice_label' => function($writer) {
                    return $writer -> getFirstname(). ' ' . $writer -> getLastname();
                },
                'label' => 'Auteur :',
                'attr' => ['class' => 'form-control text-center',
                ]])
            ->add('plot', TextareaType::class, ['label' => 'Description :', 'attr' => ['class' => 'form-control  text-center']])
            ->add('languageid', EntityType::class, [
                // looks for choices from this entity
                'class' => Language::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                'label' => 'Langue :',
                'attr' => ['class' => 'form-control  text-center',
            ]])
            ->add('publicationDate', TextType::class, ['label' => 'Date de parution :', 'attr' => ['class' => 'form-control  text-center']])
            ->add('categoryid', EntityType::class, [
                // looks for choices from this entity
                'class' => Category::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                'label' => 'Catégorie :',
                'attr' => ['class' => 'form-control  text-center',
                ]])
            ->add('quantity', IntegerType::class, ['label' => 'Quantité :', 'attr' => ['class' => 'form-control  text-center']])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer', 'attr' => ['class' => 'btn btn2 my-5']])
            ->getForm();

            $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $book = $form->getData();
            $book -> setStock($book->getQuantity());

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
        if ($book -> getStock() == $book -> getQuantity()) {
            $borrow = $entityManager->getRepository(Borrowing::class)->findBy(["book" => $id]);
            foreach ($borrow as $delete) {
                $entityManager->remove($delete);
            }
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('books_listing');
    }

    #[Route('/book/infos/{id}', name: 'book_infos')]
    public function getBook(ManagerRegistry $doctrine, int $id,Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);
        $borrow = new Borrowing;

        $form = $this->createFormBuilder($borrow)
        ->add('user', EntityType::class, [
            // looks for choices from this entity
            'class' => User::class,
            // uses the User.username property as the visible option string
            'choice_label' => 'card_number',
            'attr' => ['class' => 'form-control',
            ]])
        ->add('save', SubmitType::class, ['attr' => ['class' => 'btn btn-primary']])
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $borrow = $form->getData();
            if($book->getStock() > 0) {
            $borrow->setBook($book);
            $borrow->setBorrowingDate(date_create(date('Y-m-d')));
            $borrow->generateReturningDate(date_create(date('Y-m-d')));
            $book->updateStock(-1);
            // actually executes the queries (i.e. the INSERT query)
            $entityManager->persist($borrow);
            $entityManager->flush();
            // return $this->redirectToRoute('books_listing');
            }
        }
        $today = date_create(date('y-m-d'));
        $loans = [];
        $histories = [];
        foreach ($book->getBorrowings() as $value ) {
            if ($value->getReturningDate() === null) {
                $loans[]= $value;
            } else {
                $histories[]= $value;
            }
        }
        return $this->renderForm('book/infos.html.twig', [
            'book' => $book,
            'form' => $form,
            'today' => $today,
            'loans' => $loans,
            'histories' => $histories,
        ]);
    }
       
    #[Route('/book/return/{id_book}/{id_borrow}', name: 'book_return')]
    public function returnBook(ManagerRegistry $doctrine, int $id_book, int $id_borrow): Response
    {
        $entityManager = $doctrine->getManager();
        $borrow = $entityManager->getRepository(Borrowing::class)->find($id_borrow);
        if(!$borrow->getReturningDate()){
            $borrow->setReturningDate(date_create(date('Y-m-d')));
            $book = $entityManager->getRepository(Book::class)->find($id_book);
            $book->updateStock(+1);
        }
        $entityManager->flush();
        return $this->redirectToRoute('books_listing');
    }
}
