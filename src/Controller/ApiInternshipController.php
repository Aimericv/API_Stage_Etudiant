<?php

namespace App\Controller;

use App\Entity\Internship;
use App\Repository\CompanyRepository;
use App\Repository\InternshipRepository;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiInternshipController extends AbstractController
{
    /**
     * #[Route('/api/internship', name: 'api_internship_index')]
     *
     * @Route(
     *     "/api/internship",
     *     name="api_internship_index",
     *     methods={"GET"}
     * )
     */
    public function index( InternshipRepository $internshipRepository, NormalizerInterface $normalizer): JsonResponse
    {

  
        $internships = $internshipRepository->findAll();

        
        $json = json_encode($internships);
     
        $internshipsNormalised = $normalizer->normalize($internships,
            'json',
            [
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                }
            ]
        );

      
        dd($internships, $json, $internshipsNormalised);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiStudentController.php',
        ]);
    }

    /**
     * @Route(
     *  "/api/internship",
     *  name="app_api_internship_add",
     *  methods={"POST"}
     * )
     */
    public function add( Request $request, EntityManagerInterface $entityManager, StudentRepository $studentRepository, CompanyRepository $companyRepository): JsonResponse
    {
       
        // dd($request->toArray());

        $dataFromRequest = $request->toArray();

    
        $student = $studentRepository->find( $dataFromRequest['idStudent'] );
        $company = $companyRepository->find( $dataFromRequest['idCompany'] );
        $startDate = new \DateTime($dataFromRequest['startDate'] );
        $endDate = new \DateTime($dataFromRequest['endDate'] );

         // dd($student);
       
        $internship = new Internship();
        $internship->setIdStudent( $student );
        $internship->setIdCompany( $company );
        $internship->setStartDate( $startDate );
        $internship->setEndDate( $endDate );




 
        $entityManager->persist($internship);
        $entityManager->flush();

        return $this->json([
            'status' => 'Ajout du nouveau stage OK'
        ]);
    }

    
}