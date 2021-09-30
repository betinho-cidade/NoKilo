@component('mail::message')
# Nota Fiscal Reprovada

ooohhhhh!

Poxa, a nota fiscal enviada não foi aprovada, veja qual foi o motivo aqui.

<b>Motivo da Reprovação:</b> {{ $nota->motivo_reprovacao }}

Mas não fique triste, pois você ainda pode participar da promoção Partiu ser felixx, você de PCX!

Compre - Envie sua nota - Concorra a uma PCX 0KM

Já pensou se a sorte te der uma carona?

@component('mail::button', ['url' => 'http://api.whatsapp.com/send?1=pt_BR&phone=5575998508470'])
Fale Conosco
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
