<?php

    namespace Tests;

    use Exception;
    use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;

    trait WithoutMultitenancy
    {
        use MakesHttpRequests;

        /**
         * Prevent all middleware from being executed for this test class.
         *
         * @throws \Exception
         */
        public function disableMiddlewareForAllTests()
        {
            if (method_exists($this, 'withoutMiddleware')) {
                $this->withoutMiddleware([\LaravelEnso\Multitenancy\Http\Middleware\Multitenancy::class]);
            } else {
                throw new Exception('Unable to disable middleware. MakesHttpRequests trait not used.');
            }
        }
    }
