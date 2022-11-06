<?php

declare(strict_types=1);

namespace App\Tests\Security;

use App\Security\LoginAuthenticator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class LoginAuthenticatorTest extends TestCase
{
    private const REQUEST_FIREWALL_NAME = 'TEST';

    /** @var MockObject&UrlGeneratorInterface */
    private UrlGeneratorInterface $urlGenerator;
    /** @var MockObject&SessionInterface */
    private SessionInterface $session;
    /** @var MockObject&TokenInterface */
    private TokenInterface $token;
    private Request $request;
    private LoginAuthenticator $authenticator;

    public function setUp(): void
    {
        $this->urlGenerator  = $this->createMock(UrlGeneratorInterface::class);
        $this->session       = $this->createMock(SessionInterface::class);
        $this->token         = $this->createMock(TokenInterface::class);
        $this->authenticator = new LoginAuthenticator($this->urlGenerator);

        $this->request = new Request([], ['email' => 'test@test.de', 'password' => '123456']);
        $this->request->setSession($this->session);
    }

    public function testAuthenticate(): void
    {
        $passport = $this->authenticator->authenticate($this->request);

        $expected = new Passport(
            new UserBadge('test@test.de'),
            new PasswordCredentials('123456'),
            [new CsrfTokenBadge('authenticate', '')]
        );

        $this->assertEquals($expected, $passport);
    }

    /**
     * @dataProvider provideTargetUrl
     */
    public function testOnAuthenticationSuccess(?string $targetUrl, string $route, string $url): void
    {
        $this->session
            ->expects($this->once())
            ->method('get')
            ->with(sprintf('_security.%s.target_path', self::REQUEST_FIREWALL_NAME))
            ->willReturn($targetUrl);

        if ($targetUrl === null) {
            $this->urlGenerator
                ->expects($this->once())
                ->method('generate')
                ->with($route)
                ->willReturn($url);
        }

        $response = $this->authenticator->onAuthenticationSuccess($this->request, $this->token, self::REQUEST_FIREWALL_NAME);
        $this->assertEquals(new RedirectResponse($url), $response);
    }

    /**
     * @throws ReflectionException
     */
    public function testGetLoginUrl(): void
    {
        $this->urlGenerator
            ->expects($this->once())
            ->method('generate')
            ->with(LoginAuthenticator::LOGIN_ROUTE)
            ->willReturn('/login');

        $reflectionClass  = new ReflectionClass($this->authenticator);
        $reflectionMethod = $reflectionClass->getMethod('getLoginUrl');

        $loginUrl = $reflectionMethod->invokeArgs($this->authenticator, [$this->request]);
        $this->assertEquals('/login', $loginUrl);
    }

    protected function provideTargetUrl(): array
    {
        return [
          [null, 'admin', '/admin'],
          ['/somewhere', '/somewhere', '/somewhere'],
        ];
    }
}
