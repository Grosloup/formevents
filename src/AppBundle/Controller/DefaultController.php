<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Faculte;
use AppBundle\Entity\Filiere;
use AppBundle\Form\FiltreEtudiantType;
use AppBundle\Model\FiltreEdudiantModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $model = new FiltreEdudiantModel();
        $form = $this->createForm(FiltreEtudiantType::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            dump($model);die();
        }

        return $this->render('default/index.html.twig', [
            "form"=>$form->createView(),
        ]);
    }
    /**
     * @Route("/api/filieres", name="api_get_filieres")
     * @Method({"GET", "POST"})
     */
    public function getFilieresAction(Request $request)
    {
        $faculte = $this->getDoctrine()->getRepository("AppBundle:Faculte")->find((int)$request->request->get("faculte_id"));
        $filieres = $faculte->getFilieres()->toArray();
        return new JsonResponse($filieres);
    }
    /**
     * @Route("/api/classes", name="api_get_classes")
     * @Method({"GET", "POST"})
     */
    public function getClassesAction(Request $request)
    {
        $filiere = $this->getDoctrine()->getRepository(Filiere::class)->find($request->request->get("filiere_id"));
        $classes = $filiere->getClasses()->toArray();
        return new JsonResponse($classes);
    }

}
