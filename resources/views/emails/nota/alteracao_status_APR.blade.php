@component('mail::message')
# Nota Fiscal Aprovada

Ihuuuuuuul!

Sua nota foi validada com sucesso!

Continue participando e aumente as suas chances de ganhar uma PCX novinha!

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
