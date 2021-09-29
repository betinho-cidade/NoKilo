@component('mail::message')
# Número da Sorte Gerado

Olá, {{ $bilhete->user->name }}.

Sua Nota Fiscal informada, referente a promoção "{{ $bilhete->promocao->nome }}", somado aos pontos já existentes, gerou um novo bilhete para o sorteio.

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
