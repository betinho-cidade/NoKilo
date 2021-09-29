@component('mail::message')
# Número da Sorte PREMIADO

Olá, {{ $bilhete->user->name }}.

PARABÉNS... Seu bilhete {{ $bilhete->numero_sorte_formatado }} referente a promoção "{{ $bilhete->promocao->nome }}", foi premiado.

Aguarde mais informações sobre a premiação, para desfrutrar do seu prêmio.

## Informações Recebidas:

@component('mail::table')
| Informação    | Conteúdo                 |
| ------------- |:------------------------:|
| Promoção      |{{ $bilhete->promocao->nome }}                          |
| Nome          |{{ $bilhete->user->name }}                          |
| Número Sorte  |{{ $bilhete->numero_sorte_formatado }}                 |
@endcomponent


@component('mail::button', ['url' => 'http://api.whatsapp.com/send?1=pt_BR&phone=5575998508470'])
Fale Conosco
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
