<?php

namespace App\Controller;

use App\Entity\Card;
use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CardController extends AbstractController
{
    #[Route('/api/cards', name: 'cards', methods:['GET'])]
    public function getCards(CardRepository $cardRepository, SerializerInterface $serializer): JsonResponse
    {
        $cardList = $cardRepository->findAll();
        $jsonCardList = $serializer->serialize($cardList, 'json');
        return new JsonResponse($jsonCardList, Response::HTTP_OK, [], true);
    }

    #[Route('/api/card/{id}', name: 'card', methods:['GET'])]
    public function getCard(Card $card, SerializerInterface $serializer) : JsonResponse {

        $jsonCard = $serializer->serialize($card, 'json');
        return new JsonResponse($jsonCard, Response::HTTP_OK, ['accept' => 'json'], true);
    }

}
