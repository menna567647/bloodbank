@extends('admin.layouts.main')
@section('content')
         <div class="container mt-4">
             @if ($reports_count > 0)
                 <div class="text-center mb-3">
                     <h4>({{ __('messages.reports') }})</h4>
                 </div>
                 @if (session('message'))
                     <h2 class="text-center alert alert-success">{{ session('message') }}</h2>
                 @endif
                 <div class="d-flex justify-content-center">
                     <table class="table table-bordered table-striped w-75">
                         <thead class="text-center">
                             <tr>
                                 <th>Reason</th>
                                 <th>{{ __('messages.message') }}</th>
                                 <th>{{ __('messages.DonationRequest') }}</th>
                                 <th>{{ __('messages.action') }}</th>
                             </tr>
                         </thead>
                         <tbody class="text-center">
                             @foreach ($reports as $report)
                             <td> {{ $report->reason }}</td>
                             <td>{{ $report->message }}</td>
                             <td><a href="{{route('admin.donationDetails',$report->donation_id)}}">go to donatin details</a></td>
                             <td>
                                 <form method="POST" action="{{ route('admin.reports.destroy', $report->id) }}">
                                     @method('delete')
                                     @csrf
                                     <button onclick="return confirm('are you sure you want to delete this report?')"
                                     class="btn btn-outline-danger"
                                     type="submit">Delete Report</button>
                                    </form>
                                </td>
                             @endforeach
                         </tbody>
                     </table>
                 @else
                     <h3 class="text-center">No Reports</h3>
             @endif
         </div>
         </div>
     @endsection
