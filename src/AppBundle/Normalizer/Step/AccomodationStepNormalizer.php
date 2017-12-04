<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 16:57
 */

namespace AppBundle\Normalizer\Step;


use AppBundle\Entity\Step\AccomodationStep;
use AppBundle\Normalizer\AbstractStepNormalizer;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;

class AccomodationStepNormalizer extends AbstractStepNormalizer
{
    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param AccomodationStep $object object to normalize
     * @param string $format format the normalization result will be encoded as
     * @param array $context Context options for the normalizer
     *
     * @return array
     *
     * @throws InvalidArgumentException   Occurs when the object given is not an attempted type for the normalizer
     * @throws CircularReferenceException Occurs when the normalizer detects a circular reference when no circular
     *                                    reference handler can fix it
     * @throws LogicException             Occurs when the normalizer is not called in an expected context
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return array_merge(parent::normalize($object, $format, $context), array(
            '@type' => 'AccomodationStep',
            'place' => $object->getPlace(),
            'type' => $object->getType(),
            'company' => $object->getCompany(),
            'bookingNumber' => $object->getBookingNumber(),
        ));
    }

    /**
     * Checks whether the given class is supported for normalization by this normalizer.
     *
     * @param mixed $data Data to normalize
     * @param string $format The format being (de-)serialized from or into
     *
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof AccomodationStep;
    }
}