<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 12/04/16
 * Time: 14:31
 */

namespace AppBundle\Form\Listener;


use AppBundle\Entity\Filiere;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class AddFiliere implements EventSubscriberInterface
{


    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SET_DATA => 'onPreSetData',
            FormEvents::PRE_SUBMIT=> 'onPreSubmit',

        ];
    }

    public function onPreSetData(FormEvent $event)
    {
        $id = $event->getData()->getFaculte() !== null ? $event->getData()->getFaculte()->getId(): null;
        $this->addModifier($event->getForm(), $id);
    }

    public function onPreSubmit(FormEvent $event)
    {
        $this->addModifier($event->getForm(), $event->getData()["faculte"]);
    }

    public function addModifier(FormInterface $form, $faculte_id = null)
    {
        $form->add('filiere', EntityType::class, array(
            'class'       => Filiere::class,
            "query_builder"=>function(EntityRepository $repo) use ($faculte_id) {
                return
                    $repo->createQueryBuilder("filiere")
                        ->innerJoin("filiere.faculte", "faculte")
                        ->andWhere("faculte.id = :faculte_id")
                        ->setParameter("faculte_id", $faculte_id);
            }
        ));
    }
}