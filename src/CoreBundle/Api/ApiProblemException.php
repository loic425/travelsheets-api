<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 12:51
 */

namespace CoreBundle\Api;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiProblemException extends HttpException
{
    private $apiProblem;

    /**
     * ApiProblemException constructor.
     * @param ApiProblem $apiProblem
     * @param \Exception|NULL $previous
     * @param array $headers
     * @param int $code
     */
    public function __construct(ApiProblem $apiProblem, \Exception $previous = null, array $headers = array(), $code = 0)
    {
        $this->apiProblem = $apiProblem;
        $statusCode = $apiProblem->getStatusCode();
        $message = $apiProblem->getTitle();
        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }

    /**
     * @return ApiProblem
     */
    public function getApiProblem()
    {
        return $this->apiProblem;
    }
}