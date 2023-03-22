<?php

namespace App\Controller;


use App\Entity\Student;
use App\Repository\StudentRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use App\Service;
use App\Service\ApiKeyService;

class ApiStudentController extends AbstractController
{   
    /**
     * @Route("/api/student", name="app_api_student", methods={"GET"})
     */
    public function index(StudentRepository $studentRepository, NormalizerInterface $normalizer, ApiKeyService $apiKeyService, Request $request ): JsonResponse
    {

        $authorized = $apiKeyService->checkApiKey($request);
       

        dd($authorized);

        $students=$studentRepository->findALL();

        $json = json_encode($students);

        $studentNormalised = $normalizer->normalize(
            $students,
            'json',
            [
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                }
            ]
        );

        dd($students, $json, $studentNormalised);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiStudentController.php',
        ]);
    }

    /**
     * @Route("/api/student", name="app_api_student_add", methods={"POST"})
     */

    public function add(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {

            // dd($request->toArray());

            $dataFromRequest=$request->toArray();

            $student=new Student();
            $student->setName($dataFromRequest['name']);
            $student->setFirstname($dataFromRequest['firstname']);
            $student->setPicture($dataFromRequest['picture']);
            $student->setDateOfBirth(new DateTime($dataFromRequest['date_of_birth']));
            $student->setGrade($dataFromRequest['grade']);

            // dd($student);

            $entityManager->persist($student);
            $entityManager->flush();

            

        return $this->json([
            'status' => 'Ajout OK'
        ]); 
    
    }
}
