<?php

namespace App\Http\Middleware;

use App\Models\DailyVisit;
use App\Models\VisitLog;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountWebsiteVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $today = Carbon::today()->toDateString();

        // Tìm bản ghi hôm nay, nếu chưa có thì tạo mới
        $visit = DailyVisit::firstOrCreate(
            ['visit_date' => $today],
            ['visits' => 0]
        );

        $referrer = $request->path(); // lấy nguồn truy cập
        $ip = $request->ip();

        $visitLog = VisitLog::where([
            'visit_date' => $today,
            'referrer' => $referrer,
            'ip_address' => $ip,
        ])->first();
        if (!$visitLog) {
            VisitLog::create([
                'visit_date' => $today,
                'referrer' => $referrer,
                'ip_address' => $ip,
            ]);
            $visit->increment('visits');
        }
        
        return $next($request);
    }
}
