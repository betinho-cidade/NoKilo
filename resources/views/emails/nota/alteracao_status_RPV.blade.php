@component('mail::message')
# Nota Fiscal Reprovada

Olá, {{ $nota->user->name }}.

Sua Nota Fiscal cadastrada em nosso sistema, referente a promoção "{{ $nota->promocao->nome }}" foi REPROVADA. Ela não apresentou valores válidos para ser confirmada e portanto não pudemos registrar os pontos relacionados.

<b>Motivo da Reprovação:</b> {{ $nota->motivo_reprovacao }}

Fique à vontade para adicionar novas notas.

@component('mail::button', ['url' => 'http://api.whatsapp.com/send?1=pt_BR&phone=5575998508470'])
Fale Conosco
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
