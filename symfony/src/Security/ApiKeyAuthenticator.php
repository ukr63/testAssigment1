<?php

declare(strict_types=1);

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

class ApiKeyAuthenticator extends AbstractAuthenticator
{
    protected const HEADER_AUTH_TOKEN = 'Authorization';

    /**
     * @inheritDoc
     */
    public function supports(Request $request): ?bool
    {
        return $request->headers->has(self::HEADER_AUTH_TOKEN);
    }

    /**
     * @inheritDoc
     */
    public function authenticate(Request $request): Passport
    {
        $apiToken = $request->headers->get(self::HEADER_AUTH_TOKEN);

        if (null === $apiToken) {
            throw new CustomUserMessageAuthenticationException('Auth token not found (header: "{{ header }}")', [
                '{{ header }}' => self::HEADER_AUTH_TOKEN,
            ]);
        }

        $apiToken = trim(str_replace('Bearer ', '', $apiToken));

        if ($_ENV['AUTH_TOKEN'] !== $apiToken) {
            throw new CustomUserMessageAuthenticationException('Invalid auth token');
        }

        /**
         * mini trick to bypass original authorization
         */
        return new SelfValidatingPassport(
            new UserBadge(
                'api-user',
                function ($identifier) {
                    return new CustomUser($identifier, []);
                }
            )

        );
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        throw $exception;
    }
}
