<?php

namespace App\Controller;

use App\Entity\CurrentWeatherRequest;
use App\Form\WeatherFormType;
use App\Service\SaveWeatherRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('', name: 'weather')]
    #[Route('/results/{currentWeatherRequest}', name: 'weather_results')]
    public function index(Request $request, SaveWeatherRequestService $service, CurrentWeatherRequest $currentWeatherRequest = null): Response
    {
        $entity = new CurrentWeatherRequest();
        $form = $this->createForm(WeatherFormType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $service->save($entity);

            return $this->redirectToRoute('weather_results', ['currentWeatherRequest' => $entity->getId()]);
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
            'currentWeatherRequest' => $currentWeatherRequest,
        ]);
    }
}