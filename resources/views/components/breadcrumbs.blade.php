@php
    use Illuminate\Support\Facades\Route;

    $breadcrumbIcons = [
        'dashboard'           => 'home',
        'members'             => 'person',
        'view-profile'        => 'account_circle',
        'grantsNequipment'    => 'inventory',
        'view-grant'          => 'description',
        'grant-view-profile'  => 'account_circle', 
        'training-workshop'   => 'school',
        'announcements'       => 'campaign',
        'grant-request'       => 'folder',
        'member-application'  => 'app_registration',
        'logs'                => 'history',
        'admin-reports'       => 'bar_chart',
        'messages'            => 'email',
        'settings'            => 'settings',
    ];

    $breadcrumbName = $breadcrumbName ?? Route::currentRouteName();
    $currentRouteName = Route::currentRouteName();
@endphp

<nav class="mb-4 flex items-center space-x-2 text-base text-gray-700" aria-label="Breadcrumb">
    @foreach (Breadcrumbs::generate($breadcrumbName) as $crumb)
        @php
            $crumbRouteName = null;

            if (!empty($crumb->url)) {
                try {
                    $requestForCrumb = \Illuminate\Http\Request::create($crumb->url);
                    $matchedRoute = app('router')->getRoutes()->match($requestForCrumb);
                    $crumbRouteName = $matchedRoute ? $matchedRoute->getName() : null;
                } catch (\Throwable $e) {
                    $crumbRouteName = null;
                }
            } else {
                $crumbRouteName = $currentRouteName;
            }

            $icon = $breadcrumbIcons[$crumbRouteName] ?? null;
        @endphp

        @if ($crumb->url && !$loop->last)
            <a href="{{ $crumb->url }}" class="flex items-center text-green-700 hover:text-green-900 transition">
                @if ($crumbRouteName === 'dashboard')
                    <i class="material-icons text-green-600 mr-2" style="font-size:18px;">home</i>
                @elseif ($icon)
                    <i class="material-icons text-green-600 mr-2" style="font-size:18px;">{{ $icon }}</i>
                @endif
                <span class="text-[16px]">{{ $crumb->title }}</span>
            </a>
            <span class="text-gray-400 text-xl">›</span>
        @else
            <span class="flex items-center text-green-800 font-semibold">
                @if ($crumbRouteName === 'dashboard')
                    <i class="material-icons text-green-700 mr-2" style="font-size:18px;">home</i>
                @elseif ($icon)
                    <i class="material-icons text-green-700 mr-2" style="font-size:18px;">{{ $icon }}</i>
                @endif
                <span class="text-[16px]">{{ $crumb->title }}</span>
            </span>
        @endif
    @endforeach
</nav>
