<?php

namespace MustafaRefaey\LaravelHybrid;

use Exception;
use Illuminate\Support\Arr;

/**
 * This class is used to prepare and send an HTTP response
 */
class HybridResponse
{
    /**
     * Return a View response, or an API response
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View
     */
    public static function make(array $pageState = [])
    {
        if (request()->expectsJson()) {
            return ApiResponse::success($pageState);
        }

        // check shared state handler
        $sharedStateHandler = config('laravel-hybrid.shared-state-handler');
        if (!class_exists($sharedStateHandler)) {
            throw new Exception($sharedStateHandler . ' class does not exist!');
        }

        if (!in_array(RetrievesSharedState::class, class_implements($sharedStateHandler))) {
            throw new Exception($sharedStateHandler . ' class does not implement MustafaRefaey\\LaravelHybrid\\RetrievesSharedState');
        }

        $shared_state = self::jsonEncode((new $sharedStateHandler())->getSharedState());
        $page_state = self::jsonEncode($pageState);
        $session_success_messages = self::jsonEncode(Arr::wrap(session("success", [])));
        $session_error_messages = self::jsonEncode(session()->has('errors') ? session()->get('errors')->all() : []);

        return view()
            ->make("laravel-hybrid::main", compact(
                'page_state',
                'shared_state',
                'session_success_messages',
                'session_error_messages'
            ));
    }

    private static function jsonEncode($value): string
    {
        return str_replace("'", "&#39;", json_encode($value, JSON_UNESCAPED_UNICODE));
    }
}
