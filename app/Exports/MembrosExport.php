<?php

namespace App\Exports;

use App\Models\Membro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class MembrosExport implements FromCollection, WithMapping, WithHeadings
{


    public function __construct()
    {
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nome',
            'Celular',
            'E-mail',
            'Data Nascimento',
            'Naturalidade',
            'Sexo',
            'Cpf',
            'Estado Civil',
            'Cônjuge',
            'Data Casamento',
            'Escolaridade',
            'Profissão',
            'Nome Pai',
            'Nome Mãe',
            'Cep',
            'Cidade',
            'Uf',
            'Logradouro',
            'Número',
            'Bairro',
            'Complemento',
            'URL Imagem',
            'Data Batismo',
            'Pastor Batismo',
            'Igreja Batismo',
            'Data Profisão Fé',
            'Pastor Profisão Fé',
            'Igreja Profisão Fé',
            'Número ROL',
            'Tipo Membro',
            'Número da Ata',
            'Data Admissão',
            'Meio Admissão',
            'Data Demissão',
            'Meio Demissão',
            'Local Congregação',
            'Status do Membro',
            'Em Disciplina ?',
            'É Pastor ?',
            'Aptidões',
            'Login',
        ];
    }

    public function map($membro): array
    {

        return [
            $membro->id,
            $membro->nome,
            $membro->celular,
            $membro->email,
            Date::stringToExcel($membro->data_nascimento),
            $membro->naturalidade,
            $membro->descricao_sexo,
            $membro->cpf,
            $membro->descricao_estado_civil,
            $membro->conjuge,
            Date::stringToExcel($membro->data_casamento),
            $membro->descricao_escolaridade,
            $membro->profissao,
            $membro->nome_pai,
            $membro->nome_mae,
            $membro->end_cep,
            $membro->end_cidade,
            $membro->end_uf,
            $membro->end_logradouro,
            $membro->end_numero,
            $membro->end_bairro,
            $membro->end_complemento,
            $membro->path_imagem,
            Date::stringToExcel($membro->data_batismo),
            $membro->pastor_batismo,
            $membro->igreja_batismo,
            Date::stringToExcel($membro->data_profissao_fe),
            $membro->pastor_profissao_fe,
            $membro->igreja_profissao_fe,
            $membro->numero_rol,
            $membro->descricao_tipo_membro,
            $membro->numero_ata,
            Date::stringToExcel($membro->data_admissao),
            $membro->meio_admissao->nome ?? '',
            Date::stringToExcel($membro->data_demissao),
            $membro->meio_demissao->nome ?? '',
            $membro->local_congrega->nome ?? '',
            $membro->descricao_status,
            $membro->descricao_is_disciplina,
            $membro->descricao_is_pastor,
            $membro->aptidao,
            $membro->user->login ?? '',
        ];

    }

    public function collection()
    {

        $membros = Membro::get();

        return $membros;
    }
}
