<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 10/08/2017
 * Time: 14:52
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * StepAttachment
 *
 * @ORM\Table(name="step_attachment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StepAttachmentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class StepAttachment
{
    /**
     * @var AbstractStep
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Appbundle\Entity\AbstractStep", inversedBy="attachments", fetch="EAGER")
     */
    private $step;

    /**
     * @var Attachment
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Attachment", fetch="EAGER")
     * @ORM\JoinColumn(name="attachment_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $attachment;

    /**
     * @return AbstractStep
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @param AbstractStep $step
     * @return StepAttachment
     */
    public function setStep(AbstractStep $step)
    {
        $this->step = $step;
        return $this;
    }

    /**
     * @return Attachment
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param Attachment $attachment
     * @return StepAttachment
     */
    public function setAttachment(Attachment $attachment)
    {
        $this->attachment = $attachment;
        return $this;
    }
}