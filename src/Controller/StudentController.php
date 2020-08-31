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
        $card_uids = explode(',',base64_decode($card_uids));
        $result = array_fill_keys($card_uids, []);

        $students = $this->studentRepository->findPublicColumnsBy(
            $this->getUser()->getId(),
            true,
            ['card_uid' => $card_uids]
        );

        foreach($students as $student) {
            $card_uid = $student['card_uid'];
            unset($student['card_uid']);
            $result[$card_uid] = $student;
        }
        $view = $this->view($result, 200);

        return $this->handleView($view);
    }

    /**
     * @Route("/students/album_no/{album_nos}")
     */
    public function getStudentStudentsByAlbumNoAction(string $album_nos)
    {
        $album_nos = explode(',',base64_decode($album_nos));
        $result = array_fill_keys($album_nos, []);

        $students = $this->studentRepository->findPublicColumnsBy(
            $this->getUser()->getId(),
            ['album_no' => $album_nos]
        );

        foreach($students as $student) {
            $result[$student['album_no']] = $student;
        }

        $view = $this->view($result, 200);

        return $this->handleView($view);
    }

    /**
     * @Route("/students")
     */
    public function getStudentsAction()
    {
        $result = [];
        $students = $this->studentRepository->findPublicColumnsBy($this->getUser()->getId());

        foreach($students as $student) {
            $result[$student['album_no']] = $student;
        }

        $view = $this->view($result, 200);

        return $this->handleView($view);
    }
}