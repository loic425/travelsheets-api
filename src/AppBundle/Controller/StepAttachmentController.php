<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 06/11/2017
 * Time: 18:23
 */

namespace AppBundle\Controller;


use AppBundle\Entity\AbstractStep;
use AppBundle\Entity\StepAttachment;
use AppBundle\Entity\Travel;
use AppBundle\Form\StepAttachmentType;
use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StepAttachmentController extends BaseController
{
    /**
     * List all StepAttachments
     *
     * @param Travel $travel
     * @param AbstractStep $step
     * @param Request $request
     *
     * @return Response
     */
    public function listAction(Travel $travel, AbstractStep $step, Request $request)
    {
        $this->checkNotFound($travel, $step);

        $qb = $this->getDoctrine()
            ->getRepository(StepAttachment::class)
            ->findAllByStepQueryBuilder($step);


        $paginatedCollection = $this->get('core.factory.pagination')->createCollection($qb, $request);

        $response = $this->createApiResponse($paginatedCollection, 200);

        return $response;
    }

    /**
     * Create a StepAttachment
     *
     * @param Travel $travel
     * @param AbstractStep $step
     * @param Request $request
     *
     * @return Response
     */
    public function newAction(Travel $travel, AbstractStep $step, Request $request)
    {
        $this->checkNotFound($travel, $step);

        $stepAttachment = new StepAttachment();

        // Create and process form
        $form = $this->createForm(StepAttachmentType::class, $stepAttachment);
        $this->processForm($form, $request);

        $stepAttachment->setStep($step);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stepAttachment);
        $em->flush();

        return $this->createApiResponse($stepAttachment, 201);
    }

    /**
     * Check not found
     *
     * @param Travel $travel
     * @param AbstractStep $step
     * @param StepAttachment|null $stepAttachment
     *
     * @throws NotFoundHttpException
     */
    private function checkNotFound(Travel $travel, AbstractStep $step, StepAttachment $stepAttachment = null)
    {
        if ($step->getTravel()->getId() !== $travel->getId()) {
            throw new NotFoundHttpException();
        }

        if (isset($stepAttachment)) {
            if ($stepAttachment->getStep()->getId() !== $step->getId()) {
                throw new NotFoundHttpException();
            }
        }
    }
}