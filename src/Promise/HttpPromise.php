<?php

namespace Http\Client\Promise;

use Http\Client\Exception;
use Http\Promise\Promise;
use Psr\Http\Message\ResponseInterface;

interface HttpPromise extends Promise
{
    /**
     * {@inheritdoc}
     *
     * @return HttpPromise A new resolved http promise with value of the executed callback (onFulfilled / onRejected).
     */
    public function then(callable $onFulfilled = null, callable $onRejected = null);

    /**
     * {@inheritdoc}
     *
     * @return ResponseInterface Resolved response, null if $unwrap is set to false
     *
     * @throws Exception The http exception if $unwrap is set to true and the request failed.
     */
    public function wait($unwrap = true);
}
