<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;

// If Laravel >= 5.2 then delete 'use' and 'implements' of deprecated Middleware interface.
class HttpHeader 
{
    private $unwantedHeaderList = [
        'X-Powered-By',
        'Server',
    ];
    public function handle($request, Closure $next)
    {
        $this->removeUnwantedHeaders($this->unwantedHeaderList);
        $response = $next($request);
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->header('X-Powered-By', 'PYTHON/3.7');
        $response->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Strict-Transport-Security', 'max-age=0; includeSubDomains');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
        // $response->headers->set('Content-Security-Policy', "style-src 'self'"); // Clearly, you will be more elaborate here.
        return $response;
        
  
    }

   
    private function removeUnwantedHeaders($headerList)
    {
        foreach ($headerList as $header)
            header_remove($header);
    }
}