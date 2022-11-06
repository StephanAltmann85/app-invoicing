<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

final class LoginContext implements Context
{
    // TODO: implement tests using selenium

    private KernelInterface $kernel;

    private ?Response $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @When I request page :path
     */
    public function iRequestPage(string $path): void
    {
        $this->response = $this->kernel->handle(Request::create($path, 'GET'));
    }

    /**
     * @Then I should get redirected to :path
     */
    public function iShouldGetRedirectedTo(string $path): void
    {
        if (!$this->response instanceof RedirectResponse) {
            throw new \RuntimeException('Wrong response received');
        }

        if ($this->response->getTargetUrl() !== $path) {
            throw new \RuntimeException('Wrong redirection target');
        }
    }
}
