<div class="row">
    <div class="col-sm-5 border-right">
        @include('laravel-crm::partials.form.hidden',[
             'name' => 'lead_id',
             'value' => old('lead_id', $invoice->lead->id ?? $lead->id ?? null),
        ])
        <span class="autocomplete">
             @include('laravel-crm::partials.form.hidden',[
               'name' => 'person_id',
               'value' => old('person_id', $invoice->person->id ?? $person->id ?? null),
            ])
            <script type="text/javascript">
                let people =  {!! \VentureDrake\LaravelCrm\Http\Helpers\AutoComplete\people() !!}
            </script>
            @include('laravel-crm::partials.form.text',[
               'name' => 'person_name',
               'label' => ucfirst(__('laravel-crm::lang.contact_person')),
               'prepend' => '<span class="fa fa-user" aria-hidden="true"></span>',
               'value' => old('person_name', $invoice->person->name ?? $person->name ?? null),
               'attributes' => [
                  'autocomplete' => \Illuminate\Support\Str::random()
               ]
            ])
        </span>
        <span class="autocomplete">
            @include('laravel-crm::partials.form.hidden',[
              'name' => 'organisation_id',
              'value' => old('organisation_id', $invoice->organisation->id ?? $organisation->id ??  null),
            ])
            <script type="text/javascript">
                let organisations = {!! \VentureDrake\LaravelCrm\Http\Helpers\AutoComplete\organisations() !!}
            </script>
            @include('laravel-crm::partials.form.text',[
                'name' => 'organisation_name',
                'label' => ucfirst(__('laravel-crm::lang.organization')),
                'prepend' => '<span class="fa fa-building" aria-hidden="true"></span>',
                'value' => old('organisation_name',$invoice->organisation->name ?? $organisation->name ?? null),
                'attributes' => [
                  'autocomplete' => \Illuminate\Support\Str::random()
               ]
            ])
        </span>
        <div class="row">
            <div class="col-sm-6">
                @include('laravel-crm::partials.form.text',[
                      'name' => 'reference',
                      'label' => ucfirst(__('laravel-crm::lang.reference')),
                      'value' => old('reference', $invoice->reference ?? null)
                  ])
            </div>
            <div class="col-sm-6">
                @include('laravel-crm::partials.form.hidden',[
                     'name' => 'prefix',
                     'value' => old('prefix', ($invoice->prefix ?? $prefix->value ?? 'INV-')),
                ])
                
                @include('laravel-crm::partials.form.text',[
                    'name' => 'number',
                    'label' => ucfirst(__('laravel-crm::lang.invoice_number')),
                    'value' => old('number', $invoice->number ?? $number ?? null),
                    'prepend' => '<span aria-hidden="true">'.($invoice->prefix ?? $invoicePrefix->value ?? 'INV-').'</span>',
                ])
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                @include('laravel-crm::partials.form.text',[
                      'name' => 'issue_date',
                      'label' => ucfirst(__('laravel-crm::lang.issue_date')),
                      'value' => old('issue_date', (isset($quote->issue_date)) ? \Carbon\Carbon::parse($quote->issue_date)->format('Y/m/d') : null),
                       'attributes' => [
                         'autocomplete' => \Illuminate\Support\Str::random()
                       ]
                  ])
            </div>
            <div class="col-sm-6">
                @include('laravel-crm::partials.form.text',[
                       'name' => 'due_date',
                       'label' => ucfirst(__('laravel-crm::lang.due_date')),
                       'value' => old('due_date', (isset($quote->due_date)) ? \Carbon\Carbon::parse($quote->due_date)->format('Y/m/d') : null),
                       'attributes' => [
                         'autocomplete' => \Illuminate\Support\Str::random()
                       ]
                   ])
            </div>
        </div>
        @include('laravel-crm::partials.form.select',[
                     'name' => 'currency',
                     'label' => ucfirst(__('laravel-crm::lang.currency')),
                     'options' => \VentureDrake\LaravelCrm\Http\Helpers\SelectOptions\currencies(),
                     'value' => old('currency', $invoice->currency ?? \VentureDrake\LaravelCrm\Models\Setting::currency()->value ?? 'USD')
                 ])
        @include('laravel-crm::partials.form.textarea',[
             'name' => 'terms',
             'label' => ucfirst(__('laravel-crm::lang.terms')),
             'rows' => 5,
             'value' => old('terms', $invoice->terms ?? null)
        ])
        {{--@include('laravel-crm::partials.form.multiselect',[
            'name' => 'labels',
            'label' => ucfirst(__('laravel-crm::lang.labels')),
            'options' => \VentureDrake\LaravelCrm\Http\Helpers\SelectOptions\optionsFromModel(\VentureDrake\LaravelCrm\Models\Label::all(), false),
            'value' =>  old('labels', (isset($invoice)) ? $invoice->labels->pluck('id')->toArray() : null)
        ])--}}

        {{--@include('laravel-crm::partials.form.select',[
                 'name' => 'user_owner_id',
                 'label' => ucfirst(__('laravel-crm::lang.owner')),
                 'options' => \VentureDrake\LaravelCrm\Http\Helpers\SelectOptions\users(false),
                 'value' =>  old('user_owner_id', $invoice->user_owner_id ?? auth()->user()->id),
              ])--}}
    </div>
    <div class="col-sm-7">
        @livewire('invoice-lines',[
            'invoice' => $invoice ?? null,
            'invoiceLines' => $invoice->invoiceLines ?? null,
            'old' => old('lines')
        ])
    </div>
</div>
