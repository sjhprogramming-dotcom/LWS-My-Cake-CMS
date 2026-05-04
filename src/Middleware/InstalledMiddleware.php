<?php
declare(strict_types=1);

namespace App\Middleware;

use Cake\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class InstalledMiddleware implements MiddlewareInterface
{
    private string $lockFile;

    public function __construct(?string $lockFile = null)
    {
        $this->lockFile = $lockFile ?: (CONFIG . 'installed.lock');
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getUri()->getPath();

        // Allow installer endpoints through, and optionally allow assets
        if (str_starts_with($path, '/install')) {
            return $handler->handle($request);
        }

        // If not installed, redirect everything to /install
        if (!file_exists($this->lockFile)) {
            return (new Response())
                ->withStatus(302)
                ->withHeader('Location', '/install');
        }

        return $handler->handle($request);
    }
}
