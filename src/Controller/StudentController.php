<?php


namespace App\Controller;

use App\Repository\StudentRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;


class StudentController extends AbstractFOSRestController
{

    /**
     * @var StudentRepository
     */
    private $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * @Route("/students/card_uid/{card_uids}")
     */
    public function getStudentsByCardUidAction(string $card_uids)
    {
        $view = $this->view($this->studentRepository->findBy(['album_no' => explode(',', $card_uids)]), 200);

        return $this->handleView($view);
    }

    /**
     * @Route("/students/album_no/{album_nos}")
     */
    public function getStudentStudentsByAlbumNoAction(string $album_nos)
    {
        $view = $this->view($this->studentRepository->findBy(['album_no' => explode(',', $album_nos)]), 200);

        return $this->handleView($view);
    }

    /**
     * @Route("/students")
     */
    public function getStudentsAction()
    {
        $view = $this->view($this->studentRepository->findAll(), 200);

        return $this->handleView($view);
    }
}