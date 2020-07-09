<?php


namespace App\Controller;


use App\Entity\Student;
use App\Repository\StudentRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;


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
     * @Route("/students")
     */
    public function getStudentsAction()
    {
        $view = $this->view($this->studentRepository->findAll(), 200);

        return $this->handleView($view);
    }

    /**
     * @Route("/students/{card_uid}")
     */
    public function getStudentAction(Student $student)
    {
        $view = $this->view($student,  200);

        return $this->handleView($view);
    }
}