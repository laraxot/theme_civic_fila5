@props(['data' => []])

@php
    // #20: i recapiti di default vengono dall'ente (GetEnteDataAction), mai
    // segnaposto di un ente fittizio; i campi vuoti restano nascosti.
    $footerEnte = app(\Modules\Tenant\Actions\Ente\GetEnteDataAction::class)->execute();
    $contactData = array_filter((array) ($data['contact'] ?? []), static fn (mixed $v): bool => $v !== null && $v !== '');
    $contactGet = static function (string $key, string $enteValue = '') use ($contactData): string {
        $value = $contactData[$key] ?? null;
        if (is_string($value) && $value !== '') {
            return $value;
        }

        return $enteValue;
    };
@endphp

{{-- 
    Full Footer Template
    Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/argomenti.html
--}}

<footer class="it-footer" id="footer">
    {{-- Main Footer --}}
    <div class="it-footer-main">
        <div class="container">
            {{-- Logo Section --}}
            <div class="row">
                <div class="col-12 footer-items-wrapper logo-wrapper">
                    <img class="ue-logo" src="{{ asset('themes/Civic/design-comuni/assets/images/logo-eu-inverted.svg') }}" alt="{{ __('pub_theme::footer_full.logo.eu.label') }}">
                    <div class="it-brand-wrapper">
                        <a href="{{ $data['home_url'] ?? '/it' }}">
                            <svg class="icon" aria-hidden="true">
                                <use href="{{ asset('themes/Civic/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-pa') }}"></use>
                            </svg>
                            <div class="it-brand-text">
                                <h2 class="no_toc">{{ is_string($data['site_name'] ?? null) && $data['site_name'] !== '' ? $data['site_name'] : $footerEnte->name }}</h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- Footer Columns --}}
            <div class="row mt-8">
                {{-- Column 1: Amministrazione --}}
                <div class="col-md-3 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ $data['admin_title'] ?? __('pub_theme::footer_full.admin.heading.title') }}</h4>
                    <ul class="footer-list">
                        @foreach($data['admin_links'] ?? [
                            ['label' => 'Organi di governo', 'url' => '#'],
                            ['label' => 'Aree amministrative', 'url' => '#'],
                            ['label' => 'Uffici', 'url' => '#'],
                            ['label' => 'Enti e fondazioni', 'url' => '#'],
                            ['label' => 'Politici', 'url' => '#'],
                            ['label' => 'Documenti e dati', 'url' => '#'],
                        ] as $link)
                        <li>
                            <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                {{-- Column 2: Categorie di servizio --}}
                <div class="col-md-6 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ $data['services_title'] ?? __('pub_theme::footer_full.services.heading.title') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="footer-list">
                                @foreach(array_slice($data['service_links'] ?? [
                                    ['label' => 'Anagrafe e stato civile', 'url' => '#'],
                                    ['label' => 'Cultura e tempo libero', 'url' => '#'],
                                    ['label' => 'Vita lavorativa', 'url' => '#'],
                                    ['label' => 'Imprese e commercio', 'url' => '#'],
                                    ['label' => 'Appalti pubblici', 'url' => '#'],
                                    ['label' => 'Catasto e urbanistica', 'url' => '#'],
                                    ['label' => 'Turismo', 'url' => '#'],
                                    ['label' => 'Mobilità e trasporti', 'url' => '#'],
                                ], 0, 8) as $link)
                                <li>
                                    <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="footer-list">
                                @foreach(array_slice($data['service_links'] ?? [
                                    ['label' => 'Anagrafe e stato civile', 'url' => '#'],
                                    ['label' => 'Cultura e tempo libero', 'url' => '#'],
                                    ['label' => 'Vita lavorativa', 'url' => '#'],
                                    ['label' => 'Imprese e commercio', 'url' => '#'],
                                    ['label' => 'Appalti pubblici', 'url' => '#'],
                                    ['label' => 'Catasto e urbanistica', 'url' => '#'],
                                    ['label' => 'Turismo', 'url' => '#'],
                                    ['label' => 'Mobilità e trasporti', 'url' => '#'],
                                ], 8, 8) as $link)
                                <li>
                                    <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                
                {{-- Column 3: Contatti --}}
                <div class="col-md-3 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ $data['contact_title'] ?? __('pub_theme::footer_full.contacts.heading.title') }}</h4>
                    @php
                        $footerName = $contactGet('name', $footerEnte->name);
                        $footerAddress = $contactGet('address', $footerEnte->address);
                        $footerCap = $contactGet('cap', '');
                        $footerCity = $contactGet('city', '');
                        $footerProvince = $contactGet('province', '');
                        $footerPhone = $contactGet('phone', $footerEnte->toll_free !== '' ? $footerEnte->toll_free : $footerEnte->phone);
                        $footerEmail = $contactGet('email', $footerEnte->email);
                        $footerPec = $contactGet('pec', $footerEnte->pec);
                        $footerHours = $contactGet('hours', $footerEnte->hours);
                    @endphp
                    @if ($footerName !== '' || $footerAddress !== '' || $footerPhone !== '' || $footerEmail !== '' || $footerPec !== '')
                    <address class="footer-list">
                        @if ($footerName !== '' || $footerAddress !== '')
                        <div class="footer-list-item">
                            @if ($footerName !== '')
                            <strong>{{ $footerName }}</strong>
                            @endif
                            @if ($footerAddress !== '' || $footerCap !== '' || $footerCity !== '')
                            <p>
                                @if ($footerAddress !== ''){{ $footerAddress }}<br>@endif
                                {{ trim($footerCap.' '.$footerCity) }}{{ $footerProvince !== '' ? ' ('.$footerProvince.')' : '' }}
                            </p>
                            @endif
                        </div>
                        @endif
                        @if ($footerPhone !== '' || $footerEmail !== '' || $footerPec !== '')
                        <div class="footer-list-item">
                            <p>
                                @if ($footerPhone !== ''){{ __('pub_theme::footer_full.contacts.phone.label') }} <a href="tel:{{ $footerPhone }}">{{ $footerPhone }}</a><br>@endif
                                @if ($footerEmail !== ''){{ __('pub_theme::footer_full.contacts.email.label') }} <a href="mailto:{{ $footerEmail }}">{{ $footerEmail }}</a><br>@endif
                                @if ($footerPec !== ''){{ __('pub_theme::footer_full.contacts.pec.label') }} <a href="mailto:{{ $footerPec }}">{{ $footerPec }}</a>@endif
                            </p>
                        </div>
                        @endif
                        @if ($footerHours !== '')
                        <div class="footer-list-item">
                            <p>{{ __('pub_theme::footer_full.contacts.hours.label') }} {{ $footerHours }}</p>
                        </div>
                        @endif
                    </address>
                    @endif
                </div>
            </div>
            
            {{-- Social Media --}}
            @if($data['show_social'] ?? true)
            <div class="row mt-8">
                <div class="col-12 footer-items-wrapper social-wrapper">
                    <h4 class="footer-heading-title">{{ $data['social_title'] ?? __('pub_theme::footer_full.social.heading.title') }}</h4>
                    <ul class="list-inline text-left social-list">
                        {{-- #20: social = JSON CMS, altrimenti i profili dell'ente; mai link "#" finti --}}
                        @php
                            $footerSocials = $data['social_links'] ?? array_map(
                                static fn (array $item): array => ['label' => $item['label'], 'url' => $item['url'], 'icon' => $item['icon']],
                                $footerEnte->social
                            );
                        @endphp
                        @foreach($footerSocials as $social)
                        <li class="list-inline-item">
                            <a class="text-underline" href="{{ $social['url'] }}" aria-label="{{ $social['label'] }}" target="_blank" rel="noopener noreferrer">
                                <svg class="icon icon-white" aria-hidden="true">
                                    <use href="{{ asset('themes/Civic/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#' . $social['icon']) }}"></use>
                                </svg>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- Sponsor: solo se configurati nel JSON del footer. Nessun segnaposto "Spazio in vendita" su un sito PA (PRD-13). --}}
            @if(! empty($data['sponsors']))
            <div class="row mt-12 mb-4">
                <div class="col-12 footer-items-wrapper sponsor-wrapper">
                    <h4 class="footer-heading-title">{{ $data['sponsor_title'] ?? __('pub_theme::footer_full.sponsor.heading.title') }}</h4>
                    <p class="sponsor-subtitle">{{ $data['sponsor_subtitle'] ?? __('pub_theme::footer_full.sponsor.subtitle.help') }}</p>
                    <div class="sponsors-grid">
                        @foreach($data['sponsors'] as $sponsor)
                        <div class="sponsor-card">
                            <a href="{{ $sponsor['url'] }}" class="sponsor-link" aria-label="{{ $sponsor['label'] }}">
                                <img src="{{ asset($sponsor['img']) }}" alt="{{ $sponsor['label'] }}" class="sponsor-img" loading="lazy">
                                <div class="sponsor-overlay">
                                    <span class="sponsor-tag">{{ $sponsor['label'] }}</span>
                                    <span class="sponsor-type">{{ $sponsor['type'] }}</span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Footer Bottom --}}
    <div class="it-footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12 footer-items-wrapper">
                    <ul class="footer-bottom-list list-inline">
                        @foreach($data['bottom_links'] ?? [
                            ['label' => 'Media policy', 'url' => '#'],
                            ['label' => 'Note legali', 'url' => '#'],
                            ['label' => 'Privacy policy', 'url' => '#'],
                            ['label' => 'Mappa del sito', 'url' => '#'],
                            ['label' => 'RSS', 'url' => '#'],
                        ] as $link)
                        <li class="list-inline-item">
                            <a href="{{ $link['url'] }}" class="text-underline">{{ $link['label'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
