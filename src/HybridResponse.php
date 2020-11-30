<?php

namespace MustafaRefaey\LaravelHybrid;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

/**
 * This class is used to prepare and send an HTML View response
 */
class HybridResponse
{
    /**
     * Make an html response
     * @return Response|View
     */
    public static function make(string $page_title, array $page_state = [])
    {
        if (request()->expectsJson()) {
            return JsonResponse::success($page_state);
        }

        $page_state = self::jsonEncode($page_state);
        $shared_state = self::jsonEncode(self::sharedState());
        $initial_success_messages = self::jsonEncode(Arr::wrap(session("success", [])));
        $initial_error_messages = self::jsonEncode(session()->has('errors') ? session()->get('errors')->all() : []);
        $seo_content = self::jsonReadableEncode($page_state);

        return view("main", compact(
            'page_title',
            'page_state',
            'shared_state',
            'initial_success_messages',
            'initial_error_messages',
            'seo_content'
        ));
    }

    protected static function sharedState(): array
    {
        return [
            'authenticated' => auth()->check(),
            'auth_user' => auth()->check() ? auth()->user() : null
        ];
    }

    private static function jsonEncode($value): string
    {
        return str_replace("'", "&#39;", json_encode($value, JSON_UNESCAPED_UNICODE));
    }

    /**
     * @param object|array $in
     * @return string A string with only the string and numeric values,
     *                  without the keys of arrays, or propery names of objects
     */
    private static function jsonReadableEncode($in): string
    {
        $out = '';

        foreach ($in as $value) {
            if (is_object($value) || is_array($value)) {
                // recurse
                $out .= self::jsonReadableEncode($value);
            } elseif (is_string($value) || is_numeric($value)) {
                // only append string and numberic values
                $out .= "<br>";
                $out .= $value;
            }
        }

        return $out;
    }
}
