<?php

namespace MustafaRefaey\LaravelHybrid;

use Illuminate\Support\Arr;

/**
 * This class is used to prepare and send an HTTP response
 */
class HybridResponse
{
    /**
     * Make an html, or json response
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View
     */
    public static function make(array $page_state = [])
    {
        if (request()->expectsJson()) {
            return JsonResponse::success($page_state);
        }

        $page_state = self::jsonEncode($page_state);
        $shared_state = self::jsonEncode(self::sharedState());
        $initial_success_messages = self::jsonEncode(Arr::wrap(session("success", [])));
        $initial_error_messages = self::jsonEncode(session()->has('errors') ? session()->get('errors')->all() : []);

        return view()
            ->make("laravel-hybrid::main", compact(
                'page_state',
                'shared_state',
                'initial_success_messages',
                'initial_error_messages'
            ));
    }

    protected static function sharedState(): array
    {
        return [
            'authenticated' => auth()->check(),
            'auth_user' => auth()->user(),
        ];
    }

    private static function jsonEncode($value): string
    {
        return str_replace("'", "&#39;", json_encode($value, JSON_UNESCAPED_UNICODE));
    }
}
