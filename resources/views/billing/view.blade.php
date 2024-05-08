@extends('layouts.master')

@section('title')
{{ __('sentence.View billing') }}
@endsection

@section('content')
<div class="row">
   <div class="col">
      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      @if (session('success'))
      <div class="alert alert-success">
         {{ session('success') }}
      </div>
      @endif
   </div>
</div>
<div class="row justify-content-center">
   <div class="col">
      <div class="card shadow mb-4">
         <div class="card-body">
            <!-- ROW : Doctor informations -->
            <div class="row">
               <div class="col">
                  {!! clean(App\Setting::get_option('header_left')) !!}
               </div>
               <div class="col-md-3">
                  <p><b>{{ __('sentence.Date') }} :</b> {{ $billing->created_at->format('d-m-Y') }}<br>
                     <b>{{ __('sentence.Reference') }} :</b> {{ $billing->reference }}<br>
                     <b>{{ __('sentence.Patient Name') }} :</b> {{ $billing->User->name }}
                  </p>
               </div>
            </div>
            <!-- END ROW : Doctor informations -->
            <!-- ROW : Drugs List -->
            <div class="row justify-content-center">
               <div class="col">
                  <h5 class="text-center"><b>{{ __('sentence.Invoice') }}</b></h5>
                  <br><br>
                  <table class="table">
                     <tr>
                        <td width="10%">#</td>
                        <td width="60%">{{ __('sentence.Item') }}</td>
                        <td width="30%" align="center">{{ __('sentence.Amount') }}</td>
                     </tr>
                     @forelse ($billing_items as $key => $billing_item)
                     <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $billing_item->invoice_title }}</td>
                        <td align="center">{{ $billing_item->invoice_amount }} {{ App\Setting::get_option('currency') }}</td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="3">{{ __('sentence.Empty Invoice') }}</td>
                     </tr>
                     @endforelse
                     @empty(!$billing_item)
                     @if(App\Setting::get_option('vat') > 0)
                     <tr>
                        <td colspan="2"><strong>{{ __('sentence.Sub-Total') }}</strong></td>
                        <td align="center"><strong>{{ $billing_items->sum('invoice_amount') }}  {{ App\Setting::get_option('currency') }}</strong></td>
                     </tr>
                     <tr>
                        <td colspan="2"><strong>{{ __('sentence.VAT') }}</strong></td>
                        <td align="center"><strong> {{ App\Setting::get_option('vat') }}%</strong></td>
                     </tr>
                     @endif
                     <tr>
                        <td colspan="2"><strong>{{ __('sentence.Total') }}</strong></td>
                        <td align="center"><strong>{{ $billing_items->sum('invoice_amount') + ($billing_items->sum('invoice_amount') * App\Setting::get_option('vat')/100) }}  {{ App\Setting::get_option('currency') }}</strong></td>
                     </tr>
                     @endempty
                  </table>
                  <hr>
               </div>
            </div>
            <!-- ROW : Drugs List -->
            <div class="row justify-content-center">
               <div class="col">
                  <hr>
               </div>
            </div>
            <!-- END ROW : Drugs List -->
            <!-- ROW : Footer informations -->
            <div class="row">
               <div class="col">
                  <p>{!! clean(App\Setting::get_option('footer_left')) !!}</p>
               </div>
               <div class="col">
                  <p class="float-right">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
               </div>
            </div>
            <!-- END ROW : Footer informations -->
         </div>
      </div>
   </div>
</div>
@endsection

@section('footer')

@endsection