@props(['notifications' => null, 'type' => null, 'class' => null])

@php
    if ($notifications === null) {
        if ($type === null && isset($this) && method_exists($this, 'getName')) {
            $type = $this->getName();
        }

        $notifications = session('flash_notification', collect());

        if ($type !== '*') {
            $notifications = $notifications->filter(function ($notification) use ($type) {
                return $notification->type === $type;
            });
        }
    }

    $notifications = $notifications->groupBy('level');
@endphp

<div data-notifications-for="{{ $type }}" class="w-full">
    @foreach($notifications as $group)
        @php
            $level = $group->first()->level;
        @endphp

        <div @class([
            'text-error bg-notification-error' => $level === 'error',
            'text-warning bg-notification-warning' => $level === 'warning',
            'text-info  bg-notification-info' => $level === 'info',
            'text-success  bg-notification-success' => $level === 'success',
            'rounded-[4px] py-[6px] px-2 w-full flex text-subtitle-2',
            $class,
        ])>
            <div class="flex items-center mr-3">
                @if($level === 'error')
                    <x-icon name="exclamation-rounded" class="fill-error"/>
                @endif

                @if($level === 'warning')
                    <x-icon name="exclamation-triangle" class="fill-warning"/>
                @endif

                @if($level === 'info')
                    <x-icon name="info-rounded" class="fill-info"/>
                @endif

                @if($level === 'success')
                    <x-icon name="checkmark-rounded" class="fill-success"/>
                @endif
            </div>

            <div class="flex flex-col">
                @if($group->count() === 1)
                    @php
                        /** @var \App\Common\FlashMessage $notification */
                        $notification = $group->first();
                    @endphp

                    @if($notification->title)
                        <strong class="mb-[2px]">{{ $notification->title }}</strong>
                    @endif

                    {!! $notification->message !!}
                @else
                    <ul>
                        @foreach($group as $notification)
                            <li>{!! $notification->message !!}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endforeach
</div>
