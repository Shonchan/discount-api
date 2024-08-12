<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Service\DiscountService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DiscountController extends AbstractController
{
    /**
     * @throws \Exception
     */
    #[Route(path: '/api/v1/discount/calculate', methods: ['GET', 'POST'])]
    public function calculate(Request $request, DiscountService $service): Response
    {
        $denormalizer = new ArrayDenormalizer();
        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer([$normalizer, $denormalizer]);
        $trip = $serializer->denormalize($request->query->all(), Trip::class);

        return $this->json($service->getTotalDiscount($trip));
    }
}