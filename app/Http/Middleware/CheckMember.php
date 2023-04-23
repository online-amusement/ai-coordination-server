<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\MemberService;

class CheckMember
{
    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        $member = $this->memberService->findBy("api_token", "=", $token);

        if(!($token && $member)) {
            return response()->json([
                "result" => false,
                "status" => 401,
                "message" => "Check member fail",
            ]);
        }
        return $next($request);
    }
}
