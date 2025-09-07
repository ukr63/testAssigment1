<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\LeadStatus;
use App\Enum\LeadStatusType;
use App\Repository\LeadRepository;
use App\Repository\LeadStatusRepository;
use App\Validator\Lead as LeadValidator;
use App\Validator\ValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Lead;

final class LeadController extends AbstractController
{
    public function __construct(
        private LeadRepository $leadRepository,
        private LeadStatusRepository $leadStatusRepository
    ) {
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('lead/index.html.twig');
    }

    #[Route('/api/v1/addlead', name: 'addlead', methods: ['POST'])]
    public function addLead(Request $request, LeadValidator $leadValidator): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            $leadValidator->validate($data);
            // $previousUrl = $request->headers->get('referer');
            $lead = new Lead();
            $lead->setIp($request->getClientIp());
            $lead->setEmail($data['email']);
            $lead->setPhone($data['phone']);
            $lead->setBoxId(28);
            $lead->setClickId(
                $data['click_id'] ?? $data['fbclid'] ?? ''
            );
            $lead->setFirstName($data['first_name']);
            $lead->setLastName($data['last_name']);
            $lead->setLandingUrl($data['landing_url']);
            $lead->setOfferId(5);
            $lead->setPassword('qwerty12');
            $lead->setCountryCode('GB');
            $lead->setLanguage('en');

            $this->leadRepository->save($lead);
            $leadId = $lead->getId();

            $status = new LeadStatus();
            $status->setStatus(LeadStatusType::NEW);
            $status->setLead($lead);
            $status->setFtd(false);
            $this->leadStatusRepository->save($status);

            // send api request to get autologin link https://test-autologin.com
            return $this->json([
                'status' => true,
                'id' => $leadId,
                'email' => $lead->getEmail(),
                'autologin' => "https://test-autologin.com/?id=$leadId"
            ]);
        } catch (ValidationException $e) {
            return $this->json([
                'errors' => $e->getErrors()
            ], Response::HTTP_BAD_REQUEST);
        }
        catch (\Exception $e) {
            return $this->json([
                'message' => 'Something went wrong'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/api/v1/getstatuses', name: 'getstatuses', methods: ['POST'])]
    public function getStatuses(Request $request): JsonResponse
    {
        return $this->json([]);
    }

    #[Route('/api/test', name: 'app_lead')]
    public function api_test(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/LeadController.php',
        ]);
    }
}
