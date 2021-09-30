@component('mail::message')
# Cadastro Realizado

Ebaaaaa! \o/

Sua inscrição já está ativa! Agora é só enviar as suas notas fiscais, cruzar os dedos e quem sabe a sorte te dá uma carona?

Envie quantas notas você quiser até o dia 7 de novembro de 2021 e aumente as suas chances de ganhar!

Partiu ser felixx, você de PCX!

## Informações Recebidas:

@component('mail::table')
| Informação     | Conteúdo                 |
| -------------- |:------------------------:|
| Nome           |{{ $usuario->name }}                          |
| E-mail (login) |{{ $usuario->email }}                          |
@endcomponent


@component('mail::button', ['url' => 'http://api.whatsapp.com/send?1=pt_BR&phone=5575998508470'])
Fale Conosco
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
