<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Request\ParamFetcher;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="student_index", methods={"GET"})
     */
    public function index(Request $request, StudentRepository $studentRepository): Response
    {
        return $this->render('student/index.html.twig', [
            'students' => $studentRepository->findBy(['user_id' => $this->getUser()->getId()])
        ]);
    }

    /**
     * @Route("/uploadStudents", name="student_upload", methods={"POST"})
     * @Rest\FileParam(name="uploadedfile", nullable=false)
     */
    public function uploadStudents(ParamFetcher $paramFetcher, LoggerInterface $logger)
    {
        /** @var UploadedFile $file */
        $file = $paramFetcher->get('uploadedfile');
        $file_content = json_decode(file_get_contents($file->getPathname()));
        $user_id = $this->getUser()->getId();

        foreach ($file_content as $student_raw) {
            $student = new Student();
            $student->setAlbumNo($student_raw->album_no);
            $student->setName($student_raw->name);
            $student->setSurname($student_raw->surname);
            $student->setStartYear($student_raw->start_year);
            $student->setSemester($student_raw->semester);
            $student->setCardUid(hash(Student::UID_HASH_ALGO, $student_raw->card_uid));
            $student->setUserId($user_id);

            $this->entityManager->persist($student);
        }

        try {
            $this->entityManager->flush();
        } catch (DBALException $e) {

            $this->addFlash('danger', 'Error occured during storing students in DB');
            $logger->error($e->getMessage());
            return $this->redirectToRoute('student_index');
        }
        return $this->redirectToRoute('student_index');
    }

    /**
     * @Route("/new", name="student_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $student = new Student();
        $form = $this->createForm(  StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $student->setUserId($this->getUser()->getId());
            $student->setCardUid(hash(Student::UID_HASH_ALGO, $student->getCardUid()));
            $entityManager->flush();

            $this->addFlash('success', 'Student created successfully');

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/new.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_show", methods={"GET"})
     */
    public function show(Student $student): Response
    {
        if(!$this->checkOwnership($student)) {
            return $this->redirect('main');
        }
        return $this->render('student/show.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="student_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Student $student): Response
    {
        if(!$this->checkOwnership($student)) {
            return $this->redirect('main');
        }
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="student_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Student $student): Response
    {
        if(!$this->checkOwnership($student)) {
            return $this->redirect('main');
        }
        if ($this->isCsrfTokenValid('delete' . $student->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($student);
            $entityManager->flush();
        }

        return $this->redirectToRoute('student_index');
    }

    private function checkOwnership(Student $student) : bool
    {
        if($this->getUser()->getId() !== $student->getUserId()) {
            $this->addFlash('danger', 'You have to be owner of student');
            return false;
        }

        return true;
    }
}
