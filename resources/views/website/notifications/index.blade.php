@extends('website.layouts.main')

@section('content')
    <div class="container mt-4">
            <div class="text-center mb-3">
                <h4>({{ __('messages.Notifications') }})</h4>
                <form method="POST" action="{{ route('website.notification.delete.all') }}">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('are you sure you want to delete all notifications')" type="submit"
                        class="btn btn-outline-danger mr-2">{{ __('messages.delete_all') }}</button>
                </form>
            </div>
            @if (session('message'))
                <h2 class="text-center alert alert-success">{{ session('message') }}</h2>
            @endif
            <div>
                <table class="table table-bordered table-striped w-75">
                    <thead class="text-center">
                        <tr>
                            <th>{{ __('messages.action') }}</th>
                            <th>{{ __('messages.DonationRequest') }}</th>
                            <th>{{ __('messages.message') }}</th>
                            <th>{{ __('messages.title') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($notifications as $item)
                            <tr style="background-color: {{ $item->pivot->is_read == 1 ? '#ffffff' : '#d3d3d3' }};">
                                <td class="d-flex">
                                    <form method="POST" action="{{ route('website.notification.delete', $item->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button
                                            onclick="return confirm('are you sure you want to delete this notification')"
                                            type="submit"
                                            class="btn btn-outline-danger mr-2">{{ __('messages.delete') }}</button>
                                    </form>
                                    <form method="POST" action="{{ route('website.notification.update', $item->id) }}">
                                        @csrf
                                        @method('put')
                                        <button type="submit"
                                            class="btn btn-outline-success">{{ $item->pivot->is_read == 0 ? __('messages.mark_as_read') : __('messages.mark_as_not_read') }}</button>
                                    </form>
                                </td>
                                <td><a
                                        href="{{ route('website.details', $item->donation_id) }}">{{ __('messages.donation_details') }}</a>
                                </td>
                                <td>{{ $item->message }}</td>
                                <td>{{ $item->title }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $notifications->links() }}
                </div>
    </div>
    </div>
@endsection
