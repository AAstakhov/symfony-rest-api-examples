<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Post;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class DeserializeSubscriber implements EventSubscriberInterface
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => 'serializer.pre_deserialize',
                'method' => 'preDeserialize',
                'class' => Post::class
            ]
        ];
    }

    public function preDeserialize(PreDeserializeEvent $event)
    {
        $postData = $event->getData();
        $request = $this->requestStack->getCurrentRequest();

        $id = $request->get('id');
        if ($id !== null) {
            $postData['id'] = $id;
            $event->setData($postData);
        }
    }
}