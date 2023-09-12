<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\DTO\Notification\NotificationSenderDTO;
use App\Message\SendNotificationMessage;
use App\Serializer\NotificationSerializer;
use App\Service\Customer\CustomerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class CustomerNotificationController extends AbstractController
{
   public function __construct(
        private CustomerService $customerService,
        private NotificationSerializer $notificationSerializer,
        private MessageBusInterface $messageBus
   )
   {}

   #[Route('/api/customer/{code}/notifications', name: 'customer_notification', methods: ['POST'])]
   public function __invoke(string $code, Request$request): JsonResponse
   {
        $customer = $this->customerService->findOneByCode($code);
        $customerSettings = $customer->getCustomerSettings();

        $this->messageBus->dispatch(new SendNotificationMessage(
          new NotificationSenderDTO(
              $customerSettings->getNotificationType(),
              $customerSettings->getEmail(),
              $customerSettings->getPhoneNumber(),
              $this->notificationSerializer->deserialize($request->getContent())
          )
      ));

      return $this->json([
          'message' => sprintf("Message sent successfully via %s", $customerSettings->getNotificationType())
      ])->setStatusCode(Response::HTTP_OK);
   }
}
