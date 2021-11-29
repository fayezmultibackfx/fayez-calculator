<?php

namespace Fayez\CalculatorBundle\Controller;

use Exception;
use Fayez\CalculatorBundle\Service\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RequestStack;

class FayezCalculatorController extends AbstractController
{
    // TODO: Define the services to be injected as properties
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function sumTwoNumbers(RequestStack $requestStack, $a, $b)
    {
        $request = $requestStack->getCurrentRequest();

        if (!$request->isXmlHttpRequest()) {
            throw new AccessDeniedException();
        }

        return $this->json($this->service->sum($a, $b));
    }

    public function foo(RequestStack $requestStack, $a, $b)
    {
        $request = $requestStack->getCurrentRequest();

        if (!$request->isXmlHttpRequest()) {
            throw new AccessDeniedException();
        }

        try {
            // TODO: Your service call
            $result = $this->service->foo($a, $b);
        } catch (AccessDeniedException $e) {
            // TODO: Catch exception access denied
            return $this->json($e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            // TODO: Catch unknown exception
            return $this->json($e->getMessage(), $e->getCode());
        }

        return $this->json($result, 200);
    }

    public function createCar(RequestStack $requestStack)
    {
        $request = $requestStack->getCurrentRequest();

        if (!$request->isXmlHttpRequest()) {
            throw new AccessDeniedException();
        }

        try {
            // TODO: Example using DTO
            $carDTO = CarDTO::fromRequest($request);
            $brand = $carDTO->getBrand();
            $model = $carDTO->getModel();

            $car = $this->service->createCar($brand, $model);

            $carDTO = CarDTO::toDTO($car);
            $response = CarDTO::toResponse($carDTO);

        } catch (AccessDeniedException $e) {
            // TODO: Catch exception access denied
            return $this->json($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            // TODO: Catch unknown exception
            return $this->json('Unknown exception', $e->getCode());
        }

        return $response;
    }
}
