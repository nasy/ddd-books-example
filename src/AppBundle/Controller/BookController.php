<?php

namespace AppBundle\Controller;

use AppBundle\Response\BookResponse;
use MyCompany\Book\Application\CreateBookAction;
use MyCompany\Book\Application\UpdateBookAction;
use MyCompany\Book\DomainModel\BookRepository;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use MyCompany\Identity\Infrastructure\UUID;
use MyCompany\Book\DomainModel\BookNotFoundException;

use AppBundle\Form\Book\CreateBookForm;

use MyCompany\Book\Application\CreateBookRequest;

use AppBundle\Response\ApiResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BookController extends FOSRestController
{
    /**
     * List all books.
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+")
     * @Annotations\QueryParam(name="limit", requirements="\d+")
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getBooksAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        /** @var BookRepository $bookRepository */
        $bookRepository = $this->get('book.repository');
        $result = $bookRepository->getAll($limit, $offset);

        $response = new ApiResponse(true, $result);
        return $response->toArray();
    }

    /**
     * Get single Book
     *
     * @param int $id the book id
     *
     * @return array
     *
     */
    public function getBookAction($id)
    {
        try {
            /** @var BookRepository $bookRepository */
            $bookRepository = $this->get('create_book.action');
            $bookEntity = $bookRepository->getById($id);

            $bookResponse = new BookResponse($bookEntity);
            return $bookResponse->toArray();

        } catch (BookNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }

    /**
     * Create a Page from the submitted data.
     *
     * @param Request $request the request object
     *
     * @return array
     */
    public function postBookAction(Request $request)
    {
        $form = $this->createForm(CreateBookForm::class);
        $form->submit($request->request->all());
        if ($form->isValid()) {

            $data = $form->getData();

            /** @var CreateBookAction $createBookAction */
            $createBookAction = $this->get('update_book.action');
            $bookEntity = $createBookAction->run(
                new CreateBookRequest(
                    UUID::create(),
                    $data['title']
                )
            );
            $bookResponse = new BookResponse($bookEntity);
            return $bookResponse->toArray();

        } else {
           throw new BadRequestHttpException($form->getErrors());
        }
    }
}
