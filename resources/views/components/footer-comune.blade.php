@php
    // Recapiti e social dell'ente (#20): da GetEnteDataAction (config('ente')),
    // mai valori fissi nel componente. Ogni voce si mostra solo se valorizzata.
    $footerEnte = app(\Modules\Tenant\Actions\Ente\GetEnteDataAction::class)->execute();
@endphp
<footer class="it-footer" role="contentinfo">
    {{-- EU Logo Section --}}
    <div class="it-footer-small-helper py-4 py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img class="ue-logo" src="{{ asset('themes/Civic/design-comuni/assets/images/logo-eu-inverted.svg') }}" alt="{{ __('pub_theme::components_footer.eu.logo_alt.label') }}" style="height: 60px;">
                </div>
            </div>
        </div>
    </div>
    
    {{-- Brand Section --}}
    <div class="it-footer-main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-brand-wrapper py-4">
                        <a href="{{ url('/'.app()->getLocale()) }}" title="{{ __('pub_theme::components_header.brand.go_home.title') }}">
                            <svg width="82" height="82" class="icon" aria-hidden="true">
                                <image xlink:href="{{ asset('themes/Civic/design-comuni/assets/images/logo-comune.svg') }}"/>
                            </svg>
                            <div class="it-brand-text">
                                <div class="it-brand-title">{{ config('app.name', __('pub_theme::header.center.brand.title.label')) }}</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Top Section: Main Footer --}}
    <div class="it-footer-main">
        <div class="container">
            <div class="row g-4">
                {{-- Column 1: Administration --}}
                <div class="col-12 col-lg-3">
                    <h4 class="h5 mb-3">{{ __('pub_theme::header.center.nav.amministrazione.label') }}</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.admin.governing_bodies.label') }}</a></li>
                        <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.admin.administrative_areas.label') }}</a></li>
                        <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.admin.offices.label') }}</a></li>
                        <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.admin.bodies_foundations.label') }}</a></li>
                        <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.admin.politicians.label') }}</a></li>
                        <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.admin.staff.label') }}</a></li>
                        <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.admin.documents_data.label') }}</a></li>
                    </ul>
                </div>
                
                {{-- Column 2: Service Categories --}}
                <div class="col-12 col-lg-3">
                    <h4 class="h5 mb-3">{{ __('pub_theme::components_footer.services.heading.label') }}</h4>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.registry.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.culture.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.work_life.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.businesses.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.procurement.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.land_registry.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.tourism.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.mobility.label') }}</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.education.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.justice.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.taxes.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.environment.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.health.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.permits.label') }}</a></li>
                                <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.services.agriculture.label') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                {{-- Column 3: News & Live --}}
                <div class="col-12 col-lg-3">
                    <h4 class="h5 mb-3">{{ __('pub_theme::header.center.nav.novita.label') }}</h4>
                    <ul class="list-unstyled mb-4">
                        <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.news.news.label') }}</a></li>
                        <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.news.press_releases.label') }}</a></li>
                        <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.news.notices.label') }}</a></li>
                    </ul>
                    
                    <h4 class="h5 mb-3">{{ __('pub_theme::header.center.nav.vivere.label') }}</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.live.places.label') }}</a></li>
                        <li><a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.live.events.label') }}</a></li>
                    </ul>
                </div>
                
                {{-- Column 4: Contacts --}}
                <div class="col-12 col-lg-3">
                    <h4 class="h5 mb-3">{{ __('pub_theme::components_common.nav.contacts.label') }}</h4>
                    @if ($footerEnte->name !== '' || $footerEnte->address !== '' || $footerEnte->tax_code !== '' || $footerEnte->vat !== '')
                    <address class="text-muted">
                        @if ($footerEnte->name !== '')
                        <p><strong>{{ $footerEnte->name }}</strong></p>
                        @endif
                        @if ($footerEnte->address !== '')
                        <p>{!! nl2br(e($footerEnte->address)) !!}</p>
                        @endif
                        @if ($footerEnte->tax_code !== '' || $footerEnte->vat !== '')
                        <p>
                            @if ($footerEnte->tax_code !== '')CF: {{ $footerEnte->tax_code }}@endif
                            @if ($footerEnte->tax_code !== '' && $footerEnte->vat !== '') - @endif
                            @if ($footerEnte->vat !== '')P.IVA: {{ $footerEnte->vat }}@endif
                        </p>
                        @endif
                    </address>
                    @endif

                    @if ($footerEnte->toll_free !== '' || $footerEnte->phone !== '' || $footerEnte->email !== '' || $footerEnte->pec !== '')
                    <h5 class="h6 mb-2 mt-3">{{ __('pub_theme::components_footer.contacts.urp_full.label') }}</h5>
                    <ul class="list-unstyled">
                        @if ($footerEnte->toll_free !== '')
                        <li>
                            <a href="tel:{{ $footerEnte->toll_free }}" class="text-decoration-none">
                                <x-filament::icon icon="heroicon-o-phone" class="icon icon-sm inline me-1" aria-hidden="true" />
                                {{ __('pub_theme::components_footer.contacts.toll_free.label') }} {{ $footerEnte->toll_free }}
                            </a>
                        </li>
                        @endif
                        @if ($footerEnte->phone !== '')
                        <li>
                            <a href="tel:{{ $footerEnte->phone }}" class="text-decoration-none">
                                <x-filament::icon icon="heroicon-o-phone" class="icon icon-sm inline me-1" aria-hidden="true" />
                                {{ __('pub_theme::components_footer.contacts.switchboard.label') }} {{ $footerEnte->phone }}
                            </a>
                        </li>
                        @endif
                        @if ($footerEnte->email !== '')
                        <li>
                            <a href="mailto:{{ $footerEnte->email }}" class="text-decoration-none">
                                <x-filament::icon icon="heroicon-o-envelope" class="icon icon-sm inline me-1" aria-hidden="true" />
                                {{ $footerEnte->email }}
                            </a>
                        </li>
                        @endif
                        @if ($footerEnte->pec !== '')
                        <li>
                            <a href="mailto:{{ $footerEnte->pec }}" class="text-decoration-none">
                                <x-filament::icon icon="heroicon-o-shield-check" class="icon icon-sm inline me-1" aria-hidden="true" />
                                {{ $footerEnte->pec }}
                            </a>
                        </li>
                        @endif
                    </ul>
                    @endif
                    
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">{{ __('pub_theme::components_footer.help.faq.label') }}</a>
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">{{ __('pub_theme::components_footer.help.appointment.label') }}</a>
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">{{ __('pub_theme::components_common.fields.report.label') }}</a>
                        <a href="#" class="btn btn-outline-primary btn-sm">{{ __('pub_theme::components_common.footer.support.label') }}</a>
                    </div>
                </div>
            </div>
            
@if(config('comune.adsense.footer_enabled', false))
    <div class="it-footer-sponsor-ad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="ad-slot ad-slot-desk d-none d-lg-block">
                        <span class="ad-label">{{ config('comune.adsense.labels.desk', __('pub_theme::components_footer.ads.desktop.label')) }}</span>
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:728px;height:90px"
                             data-ad-client="{{ config('comune.adsense.client_id', 'ca-pub-XXXXXXXX') }}"
                             data-ad-slot="{{ config('comune.adsense.slots.spazio_in_vendita_desk', 'footer-sponsor-desk') }}"></ins>
                    </div>
                    <div class="ad-slot ad-slot-tablet d-none d-md-block d-lg-none">
                        <span class="ad-label">{{ config('comune.adsense.labels.tablet', __('pub_theme::components_footer.ads.tablet.label')) }}</span>
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:468px;height:60px"
                             data-ad-client="{{ config('comune.adsense.client_id', 'ca-pub-XXXXXXXX') }}"
                             data-ad-slot="{{ config('comune.adsense.slots.spazio_in_vendita_tablet', 'footer-sponsor-tablet') }}"></ins>
                    </div>
                    <div class="ad-slot ad-slot-mobile d-block d-md-none">
                        <span class="ad-label">{{ config('comune.adsense.labels.mobile', __('pub_theme::components_footer.ads.mobile.label')) }}</span>
                        <ins class="adsbygoogle"
                             style="display:block;width:min(320px,100%);height:50px"
                             data-ad-client="{{ config('comune.adsense.client_id', 'ca-pub-XXXXXXXX') }}"
                             data-ad-slot="{{ config('comune.adsense.slots.spazio_in_vendita_mobile', 'footer-sponsor-mobile') }}"></ins>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(config('comune.sponsor.area_enabled', true))
    <div class="row sponsor-section mt-5 pt-4 border-top">
        <div class="col-12">
            <h4 class="h5 mb-3 text-center">{{ config('comune.sponsor.area_title', __('pub_theme::components_footer.sponsors.title.label')) }}</h4>
            <div class="mb-3 text-center">
                <p class="text-muted small">{{ config('comune.sponsor.area_description', __('pub_theme::components_footer.sponsors.description.text'))}}</p>
            </div>
            <div class="sponsor-logos d-flex flex-wrap justify-content-center gap-3 mb-4">
                @php
                    $maxLogos = config('comune.sponsor.logos_max', 8);
                    $logos = array_filter(config('comune.sponsor.logos', []));
                @endphp
                @foreach($logos as $logoKey => $logoUrl)
                    @if($logoUrl && $loop->iteration <= $maxLogos)
                        <div class="sponsor-logo-item bg-light p-3 rounded border" style="width: {{ 100 / min($maxLogos, count($logos)) }}%; max-width: 150px;">
                            <img src="{{ $logoUrl }}" alt="{{ __('pub_theme::components_footer.sponsors.logo_alt.label', ['partner' => $logoKey]) }}" class="img-fluid" loading="lazy">
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="sponsor-disclosure text-muted small text-center">
                <p><em>{{ __('pub_theme::components_footer.sponsors.disclosure.text') }}</em></p>
            </div>
        </div>
    </div>
    @endif

    {{-- AdSense Script --}}
    @if(config('comune.adsense.footer_enabled', false))
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ config('comune.adsense.client_id', 'ca-pub-XXXXXXXX') }}"
            crossorigin="anonymous"></script>
    @endif
        </div>
    </div>
    
    {{-- Bottom Section --}}
    <div class="it-footer-bottom">
        <div class="container">
            <div class="row align-items-center py-3">
                {{-- Legal Links --}}
                <div class="col-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none">{{ __('pub_theme::components_footer.legal.transparent_administration.label') }}</a>
                        </li>
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none">{{ __('pub_theme::legal.documents.privacy.title') }}</a>
                        </li>
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none">{{ __('pub_theme::legal.documents.legal_notes.title') }}</a>
                        </li>
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none">{{ __('pub_theme::accessibility.page.title.text') }}</a>
                        </li>
                    </ul>
                </div>
                
                {{-- Social Media: solo i profili configurati per l'ente (#20) --}}
                @if ($footerEnte->social !== [])
                <div class="col-12 col-md-6 text-center text-md-end">
                    <span class="me-2">{{ __('pub_theme::header.center.social.follow.label') }}</span>
                    @foreach ($footerEnte->social as $socialItem)
                    <a href="{{ $socialItem['url'] }}" class="text-decoration-none me-2" rel="noopener noreferrer" aria-label="{{ $socialItem['label'] }}" target="_blank">
                        {{ $socialItem['label'] }}
                    </a>
                    @endforeach
                </div>
                @else
                <div class="col-12 col-md-6"></div>
                @endif
            </div>
            
            {{-- Bottom Links --}}
            <div class="row">
                <div class="col-12 text-center">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none">{{ __('pub_theme::legal.documents.media_policy.title') }}</a>
                        </li>
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none">{{ __('pub_theme::sitemap.meta.title') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
