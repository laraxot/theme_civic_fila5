@props(['data' => []])

@php
    $entityName = (string) ($data['entity_name'] ?? config('ente.name') ?: config('app.name', ''));
    $description = $data['description'] ?? __('pub_theme::flow_report.privacy.description.message', [
        'entity' => $entityName !== '' ? $entityName : __('pub_theme::flow_report.privacy.description.entity_fallback'),
    ]);
    $privacyLinkLabel = $data['privacy_link_label'] ?? __('pub_theme::flow_report.privacy.link_label.label');
    $acceptLabel = $data['accept_label'] ?? __('pub_theme::flow_report.privacy.accept_label.label');
    $nextLabel = $data['next_label'] ?? __('pub_theme::blocks_common.shared.next.label');
    $nextUrl = $data['next_url'] ?? '/it/tests/segnalazione-02-dati';
    $step = $data['step'] ?? 1;
    $steps = $data['steps'] ?? ['Autorizzazioni e condizioni', 'Dati di segnalazione', 'Riepilogo'];
@endphp

<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <nav class="cmp-breadcrumbs mb-6" aria-label="{{ __('pub_theme::blocks_common.shared.breadcrumb.label') }}">
                <ol class="flex flex-wrap items-center gap-2 text-sm text-[#5d7083]">
                    <li><a href="{{ route('container0.index', ['container0' => 'tests'], false) }}" class="text-[#007a52] underline underline-offset-2 hover:text-[#005c3d]">{{ __('pub_theme::blocks_common.shared.home.label') }}</a><span class="mx-1" aria-hidden="true">/</span></li>
                    <li><a href="{{ route('container0.index', ['container0' => 'tests'], false) }}" class="text-[#007a52] underline underline-offset-2 hover:text-[#005c3d]">{{ __('pub_theme::blocks_common.shared.services.label') }}</a><span class="mx-1" aria-hidden="true">/</span></li>
                    <li class="text-[#17324d]" aria-current="page">{{ __('pub_theme::flow_report.shared.service_issue_report.label') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <h1 class="title-xxxlarge mb-4 text-4xl font-bold leading-tight text-[#17324d] md:text-5xl">{{ __('pub_theme::flow_report.shared.service_issue_report.label') }}</h1>
        </div>
        <div class="col-12">
            <div class="steppers mt-6" data-element="stepper">
                <div class="steppers-header flex items-center justify-between border-b-2 border-[#d9e2e8] pb-3">
                    <ul class="flex flex-wrap gap-6" role="list">
                        @foreach($steps as $index => $stepLabel)
                            @php $isActive = ($index + 1) === $step; @endphp
                            <li class="flex items-center gap-2 {{ $isActive ? 'text-[#007a52] font-semibold' : 'text-[#5d7083]' }}" {{ $isActive ? 'aria-current="step"' : '' }}>
                                <span class="flex h-6 w-6 items-center justify-center rounded-full border-2 {{ $isActive ? 'border-[#007a52] bg-[#007a52] text-white' : 'border-[#d9e2e8] text-[#5d7083]' }} text-xs font-bold">{{ $index + 1 }}</span>
                                <span class="text-sm">{{ $stepLabel }}</span>
                                @if($isActive)<span class="visually-hidden">{{ __('pub_theme::flow_report.shared.active.label') }}</span>@endif
                            </li>
                        @endforeach
                    </ul>
                    <span class="steppers-index text-sm font-semibold text-[#5d7083]" aria-hidden="true">{{ $step }}/{{ count($steps) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 pb-40 pb-lg-80">
            <p class="text-paragraph mb-lg-4 text-base leading-7 text-[#334e68]">
                {{ $description }}
            </p>
            <p class="text-paragraph mb-0 text-base leading-7 text-[#334e68]">
                {{ __('pub_theme::flow_report.privacy.for_details_on_how_personal_data.message') }}
                <a href="#" class="t-primary font-semibold text-[#007a52] underline underline-offset-2">{{ $privacyLinkLabel }}.</a>
            </p>

            <div class="form-check mt-4 mb-3 mt-md-40 mb-lg-40">
                <div class="checkbox-body flex items-start gap-3">
                    <input type="checkbox" id="privacy" name="privacy-field" value="privacy-field"
                           x-data="{}" data-element="privacy-consent"
                           class="mt-1 h-5 w-5 cursor-pointer rounded border-2 border-[#5d7083] text-[#007a52] focus:ring-2 focus:ring-[#80c8ad]">
                    <label class="title-small-semi-bold pt-1 cursor-pointer font-semibold text-[#17324d]" for="privacy">{{ $acceptLabel }}</label>
                </div>
            </div>
            <a href="{{ $nextUrl }}"
               class="btn btn-primary mobile-full inline-flex min-h-12 min-w-[120px] items-center justify-center rounded-md bg-[#007a52] px-5 py-3 font-bold text-white transition-colors hover:bg-[#005c3d] focus:outline-none focus:ring-4 focus:ring-[#80c8ad] focus:ring-offset-2"
               x-data="{ checked: false }"
               :class="{ 'opacity-50 cursor-not-allowed': !checked }"
               :aria-disabled="!checked"
               @click="if (!checked) { $event.preventDefault(); }"
               data-element="step-next">
                <span class="">{{ $nextLabel }}</span>
            </a>
        </div>
    </div>
</div>

@include('pub_theme::components.blocks.flow.segnalazione.partials.contacts-card')
