{{--
    Card "contatti" condivisa dai blocchi flow/segnalazione/* (#20: UI ripetuta in partial).
    Il numero verde arriva dall'ente (GetEnteDataAction → config('ente')); se non è
    configurato la voce non si mostra, mai un placeholder.
--}}
@php
    $flowContactsEnte = app(\Modules\Tenant\Actions\Ente\GetEnteDataAction::class)->execute();
    $flowTollFree = $flowContactsEnte->toll_free !== '' ? $flowContactsEnte->toll_free : $flowContactsEnte->phone;
@endphp
<div class="bg-[#f5f7f9] py-12 shadow-contacts">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 offset-lg-3 p-contacts">
                <div class="cmp-contacts">
                    <div class="card w-100 rounded-lg border border-[#d9e2e8] bg-white shadow-sm">
                        <div class="card-body p-6">
                            <h2 class="title-medium-2-semi-bold text-xl font-semibold text-[#17324d]">{{ __('pub_theme::flow_report.shared.contact_the_municipality.label') }}</h2>
                            <ul class="contact-list mt-4 space-y-3 p-0">
                                <li><a class="list-item flex items-center gap-3 text-[#007a52] hover:text-[#005c3d]" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'domande-frequenti'], false) }}"><svg class="icon icon-primary icon-sm h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke-width="2"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3" stroke-width="2" stroke-linecap="round"/><line x1="12" y1="17" x2="12.01" y2="17" stroke-width="2" stroke-linecap="round"/></svg><span>{{ __('pub_theme::blocks_common.shared.read_the_frequently_asked_questions.label') }}</span></a></li>
                                <li><a class="list-item flex items-center gap-3 text-[#007a52] hover:text-[#005c3d]" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'assistenza-01-dati'], false) }}" data-element="contacts"><svg class="icon icon-primary icon-sm h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" stroke-width="2"/><path d="M3 7l9 6 9-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg><span>{{ __('pub_theme::blocks_common.shared.request_assistance.label') }}</span></a></li>
                                @if ($flowTollFree !== '')
                                <li><a class="list-item flex items-center gap-3 text-[#007a52] hover:text-[#005c3d]" href="tel:{{ $flowTollFree }}"><svg class="icon icon-primary icon-sm h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 5a2 2 0 012-2h2l2 5-2 2a12 12 0 006 6l2-2 5 2v2a2 2 0 01-2 2A17 17 0 013 5z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg><span>{{ __('pub_theme::blocks_common.shared.call_the_toll_free_number_05.label') }} {{ $flowTollFree }}</span></a></li>
                                @endif
                                <li><a class="list-item flex items-center gap-3 text-[#007a52] hover:text-[#005c3d]" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'appuntamento-01-ufficio'], false) }}" data-element="appointment-booking"><svg class="icon icon-primary icon-sm h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="17" rx="2" stroke-width="2"/><line x1="3" y1="9" x2="21" y2="9" stroke-width="2"/><line x1="8" y1="2" x2="8" y2="6" stroke-width="2" stroke-linecap="round"/><line x1="16" y1="2" x2="16" y2="6" stroke-width="2" stroke-linecap="round"/></svg><span>{{ __('pub_theme::blocks_common.shared.book_an_appointment.label') }}</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
