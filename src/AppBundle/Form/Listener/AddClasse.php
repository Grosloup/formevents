<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 12/04/16
 * Time: 14:49
 */

namespace AppBundle\Form\Listener;


use AppBundle\Entity\Classe;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class AddClasse implements EventSubscriberInterface
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
        $id = $event->getData()->getFiliere() !== null ? $event->getData()->getFiliere()->getId(): null;
        $this->addModifier($event->getForm(), $id);
    }

    public function onPreSubmit(FormEvent $event)
    {
        $this->addModifier($event->getForm(), $event->getData()["filiere"]);
    }

    public function addModifier(FormInterface $form, $filiere_id = null)
    {

        $form->add('classe', EntityType::class, array(
            'class'       => Classe::class,
            "query_builder"=>function(EntityRepository $repo) use ($filiere_id) {
                return
                    $repo->createQueryBuilder("classe")
                        ->innerJoin("classe.filiere", "filiere")
                        ->andWhere("filiere.id = :filiere_id")
                        ->setParameter("filiere_id", $filiere_id);
            }
        ));
    }
}