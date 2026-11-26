@props([
    'lat' => null,
    'lng' => null,
    'label' => __('pub_theme::blocks_content.mappa_static.damage_to_be_repaired.label'),
    'recordLat' => null,
    'recordLng' => null,
])

@php
    // #20: il centro di fallback arriva dalla config del tema
    // (theme.features.map.default_center), non da coordinate di una città specifica.
    $defaultCenter = config('theme.features.map.default_center', [45.4642, 9.1900]);
    $fallbackLat = is_array($defaultCenter) && isset($defaultCenter[0]) ? (float) $defaultCenter[0] : 45.4642;
    $fallbackLng = is_array($defaultCenter) && isset($defaultCenter[1]) ? (float) $defaultCenter[1] : 9.1900;
    $centerLat = (float) ($recordLat ?? $lat ?? $fallbackLat);
    $centerLng = (float) ($recordLng ?? $lng ?? $fallbackLng);
@endphp

{{-- Logica: usa coordinate record se presenti; altrimenti geolocalizza l'utente; fallback = centro mappa configurato --}}
<div
    x-data="{
        latInit: {{ $centerLat }},
        lngInit: {{ $centerLng }},
        labelInit: '{{ addslashes($label) }}',
        centerOnUser() {
            if (!navigator.geolocation) {
                this.latInit = {{ $centerLat }};
                this.lngInit = {{ $centerLng }};
                return;
            }
            navigator.geolocation.getCurrentPosition(
                (pos) => {
                    this.latInit = pos.coords.latitude;
                    this.lngInit = pos.coords.longitude;
                },
                (err) => {
                    // fallback: usa record o centro configurato; non blocca
                    this.latInit = {{ $centerLat }};
                    this.lngInit = {{ $centerLng }};
                },
                { enableHighAccuracy: true, timeout: 5000, maximumAge: 30000 }
            );
        }
    }"
    x-init="centerOnUser()"
    class="geo-map-container bg-emerald-50 rounded-xl p-4 shadow-sm border border-emerald-100"
>
    <h3 class="text-emerald-800 font-bold mb-2">{{ __('pub_theme::blocks_content.mappa_static.location_of_the_damage.label') }}</h3>
    <p class="text-xs text-emerald-600 mb-3">{{ __('pub_theme::blocks_content.mappa_static.the_map_centres_on_where_you.message') }}</p>

    <div class="map-canvas h-64 bg-gradient-to-br from-emerald-100 to-teal-50 rounded-lg flex items-center justify-center relative overflow-hidden">
        <svg x-ref="mapSvg" viewBox="0 0 400 300" class="w-full h-full" aria-label="{{ __('pub_theme::blocks_content.geo_static_map.map_with_pin.label', ['label' => $label]) }}" role="img" data-geo-local="true">
            <rect width="400" height="300" fill="#e8f5e9"/>
            <path d="M0 150 Q100 100 200 150 T400 150 L400 300 L0 300 Z" fill="#c8e6c9" opacity="0.6"/>
            {{-- Il pin si sposta in base a latInit/lngInit tramite x-bind (SVG dinamico tramite Alpine) --}}
            <g :transform="'translate(' + (200 + (latInit - {{ $centerLat }}) * 5000) + ',' + (150 - (lngInit - {{ $centerLng }}) * 3000) + ')'">
                <circle cx="0" cy="0" r="8" fill="#007a52" stroke="#fff" stroke-width="2"/>
                <text x="0" y="15" text-anchor="middle" fill="#17324d" font-size="9">{{ $label }}</text>
            </g>
        </svg>
    </div>

    <div class="mt-3 text-xs text-emerald-700 flex gap-4">
        <span>{{ __('pub_theme::blocks_content.mappa_static.lat_colon.label') }} <span x-text="latInit.toFixed(4)"></span></span>
        <span>{{ __('pub_theme::blocks_content.mappa_static.lng_colon.label') }} <span x-text="lngInit.toFixed(4)"></span></span>
        <span class="text-emerald-500" x-show="latInit === {{ $centerLat }} && lngInit === {{ $centerLng }}">{{ __('pub_theme::blocks_content.mappa_static.current_position_or_reference_point.label') }}</span>
    </div>
</div>
