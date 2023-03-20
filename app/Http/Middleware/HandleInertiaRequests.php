<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => [
                //'success' => $request->session()->get('success'),
                'message' => fn () => $request->session()->get('message')
            ],

            'menus' =>[
                [
                    'label' => 'Dashboard' ,
                    'url'   => route('dashboard'),
                    'isActive'=> $request->routeIs('dashboard'),
                    'isVisible'=> true,
                ],
                [
                    'label' => 'Permissions' ,
                    'url'   => route('permissions.index'),
                    'isActive'=> $request->routeIs('permissions.*'),
                    'isVisible'=> $request->user()?->can('view permissions module'),
                ],
                [
                    'label' => 'Roles' ,
                    'url'   => route('roles.index'),
                    'isActive'=> $request->routeIs('roles.*'),
                    'isVisible'=> $request->user()?->can('view roles module'),
                ],
                [
                    'label' => 'Users' ,
                    'url'   => route('users.index'),
                    'isActive'=> $request->routeIs('users.*'),
                    'isVisible'=> $request->user()?->can('view users module'),
                ],
            ],

            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
//            'flash' => [
//                'message' => fn () => $request->session()->get('message')
//            ],

        ]);
    }
}
