<?php

namespace Http\Client\Promise;

use Http\Client\Exception;

final class HttpRejectedPromise implements HttpPromise
{
    /**
     * @var Exception
     */
    private $exception;

    /**
     * @param Exception $exception
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * {@inheritdoc}
     */
    public function then(callable $onFulfilled = null, callable $onRejected = null)
    {
        if (null === $onRejected) {
            return $this;
        }

        try {
            return new HttpFulfilledPromise($onRejected($this->exception));
        } catch (Exception $e) {
            return new self($e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getState()
    {
        return HttpPromise::REJECTED;
    }

    /**
     * {@inheritdoc}
     */
    public function wait($unwrap = true)
    {
        if ($unwrap) {
            throw $this->exception;
        }
    }
}
