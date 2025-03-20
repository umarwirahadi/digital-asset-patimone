<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddCommondQueryParameter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,string $parameterName, $defaultValue=null)
    {
        $parameterValue = session($parameterName, $defaultValue); // Try to get from session, fallback to default

        if ($parameterValue !== null) {
            $request->query->set($parameterName, $parameterValue);
            $request->attributes->set($parameterName, $parameterValue);

            $response = $next($request);

            if ($response instanceof \Illuminate\Http\RedirectResponse) {
                $response->setTargetUrl(
                    $response->getTargetUrl() . (parse_url($response->getTargetUrl(), PHP_URL_QUERY) ? '&' : '?') . $parameterName . '=' . urlencode($parameterValue)
                );
            }

            return $response;
        }

        return $next($request); // If no value in session, proceed without the parameter

     /*    $value = is_callable($paramterValue) ? call_user_func($paramterValue) : $paramterValue;
        $request->query->set($parameterName,$value);
        $request->attributes->set($parameterName,$value);
        $response = $next($request);
        if ($response instanceof \Illuminate\Http\RedirectResponse) {
            $response->setTargetUrl(
                $response->getTargetUrl() . (parse_url($response->getTargetUrl(), PHP_URL_QUERY) ? '&' : '?') . $parameterName . '=' . urlencode($value)
            );
        }
        // return $next($request);
        return $response; */
    }
}
