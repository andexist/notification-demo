<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Exception\JsonParsingException;
use App\Exception\MissingResourceException;
use App\Exception\NotificationsSender\EmptyNotificationJsonDataValueException;
use App\Exception\NotificationsSender\MissingNotificationJsonDataKeyException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use App\Exception\NotificationsSender\SenderClassNotFoundException;
use App\Exception\NotificationsSender\SenderTypeNotSupportedException;
use App\Exception\NotificationsSender\SendMethodNotFoundException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HandlerFailedException) { 
            $wrappedException = $exception->getPrevious();
            $this->handleCustomException($event, $wrappedException); 
        }

        $this->handleCustomException($event, $exception);
    }

    private function handleCustomException($event, $exception)
    {
        $responseMapping = [
            JsonParsingException::class => [
                'status' => Response::HTTP_BAD_REQUEST,
                'type' => 'JsonParsingException',
            ],
            MissingNotificationJsonDataKeyException::class => [
                'status' => Response::HTTP_BAD_REQUEST,
                'type' => 'MissingNotificationJsonDataKeyException',
            ],
            EmptyNotificationJsonDataValueException::class => [
                'status' => Response::HTTP_BAD_REQUEST,
                'type' => 'EmptyNotificationJsonDataValueException',
            ],
            SenderTypeNotSupportedException::class => [
                'status' => Response::HTTP_BAD_REQUEST,
                'type' => 'SenderTypeNotSupportedException',
            ],
            MissingResourceException::class => [
                'status' => Response::HTTP_NOT_FOUND,
                'type' => 'MissingResourceException',
            ],
            SenderClassNotFoundException::class => [
                'status' => Response::HTTP_NOT_FOUND,
                'type' => 'SenderClassNotFoundException',
            ],
            SendMethodNotFoundException::class => [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'type' => 'SendMethodNotFoundException',
            ],
        ];

        foreach ($responseMapping as $exceptionType => $responseInfo) {
            if ($exception instanceof $exceptionType) {
                $response = new JsonResponse([
                    'status' => $responseInfo['status'],
                    'error' => [
                        'code' => $responseInfo['status'],
                        'type' => $responseInfo['type'],
                        'message' => $exception->getMessage(),
                    ],
                ], $responseInfo['status']);
    
                $event->setResponse($response);
                break;
            }
        }
    }
}
