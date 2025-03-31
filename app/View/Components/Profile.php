<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    /**
     * URL data for the profile menu
     */
    public array $urls;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->urls = $this->prepareUrls();
    }

    /**
     * Prepare navigation URLs based on auth status
     */
    protected function prepareUrls(): array
    {
        if (Auth::check()) {
            return [
                [
                    'label' => 'Dashboard',
                    'url' => route('filament.admin.pages.dashboard'),
                    'icon' => 'heroicon-o-home'
                ],
                [
                    'label' => 'Logout',
                    'url' => route('filament.admin.auth.logout'),
                    'method' => 'post',
                    'icon' => 'heroicon-o-arrow-left-on-rectangle'
                ]
            ];
        }

        return [
            [
                'label' => 'Register',
                'url' => route('register'),
                'icon' => 'heroicon-o-user-plus'
            ],
            [
                'label' => 'Login',
                'url' => route('login'),
                'icon' => 'heroicon-o-arrow-right-on-rectangle'
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.profile', [
            'urls' => $this->urls
        ]);
    }
}
