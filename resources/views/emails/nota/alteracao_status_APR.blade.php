@component('mail::message')
# Nota Fiscal Aprovada

Olá, {{ $nota->user->name }}.

Sua Nota Fiscal cadastrada em nosso sistema, referente a promoção "{{ $nota->promocao->nome }}" foi APROVADA. Ela foi confirmada com a data de {{ $nota->data_nota_formatada }} e com o valor de {{ $nota->valor_nota }}.

A quantidade de Pontos geradas foi {{ $nota->pontos()->sum('quantidade') }}.

## Informações Recebidas:

@component('mail::table')
| Informação    | Conteúdo                 |
| ------------- |:------------------------:|
| Promoção      |{{ $nota->promocao->nome }}                          |
| Loja          |{{ $nota->franquia->nome }}                          |
| Nome          |{{ $nota->user->name }}                          |
| Data Nota     |{{ $nota->data_nota_formatada }}                 |
| Valor Nota    |{{ $nota->valor_nota }}                          |
| Pontos        |{{ $nota->pontos()->sum('quantidade') }}         |
@endcomponent


@component('mail::button', ['url' => 'http://api.whatsapp.com/send?1=pt_BR&phone=5575998508470'])
Fale Conosco
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
