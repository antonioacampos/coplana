<?php

namespace App\Http\Controllers;

use App\Models\Amendoim;
use Illuminate\Http\Request;

class InputController extends Controller
{
    protected $sectionInputsAmendoim = [
        'preparo' => [
            ['name' => 'gradagem_pesada', 'label' => 'Custo unitário da passagem da Gradagem Pesada:', 'placeholder' => 'Digite o custo unitário da passagem da Gradagem Pesada'],
            ['name' => 'aracao_iveca', 'label' => 'Custo unitário da passagem da Aração (Iveca):', 'placeholder' => 'Digite o custo unitário da passagem da Aração (Iveca)'],
            ['name' => 'gradagem_intermediaria', 'label' => 'Custo unitário da passagem da Gradagem Intermediária:', 'placeholder' => 'Digite o custo unitário da passagem da Gradagem Intermediária'],
            ['name' => 'gradagem_niveladora', 'label' => 'Custo unitário da passagem da Gradagem Niveladora:', 'placeholder' => 'Digite o custo unitário da passagem da Gradagem Niveladora'],
            ['name' => 'canteirizacao', 'label' => 'Custo unitário da passagem da Enxada Rotativa (Canteirização):', 'placeholder' => 'Digite o custo unitário da passagem da Enxada Rotativa (Canteirização)'],
            ['name' => 'subsolagem', 'label' => 'Custo unitário da passagem da Subsolagem:', 'placeholder' => 'Digite o custo unitário da passagem da Subsolagem'],
            ['name' => 'pulverizacao_dessecacao', 'label' => 'Custo unitário da aplicação da Pulverização de Dessecação Pré-Plantio:', 'placeholder' => 'Digite o custo unitário da aplicação da Pulverização de Dessecação Pré-Plantio'],
            ['name' => 'calcario', 'label' => 'Custo unitário da tonelada do Calcário:', 'placeholder' => 'Digite o custo unitário da tonelada do Calcário'],
            ['name' => 'fertilizante_fosfatado', 'label' => 'Custo unitário da tonelada do Fertilizante Fosfatado:', 'placeholder' => 'Digite o custo unitário da tonelada do Fertilizante Fosfatado'],
            ['name' => 'fertilizante_potassico', 'label' => 'Custo unitário da tonelada do Fertilizante Potássico:', 'placeholder' => 'Digite o custo unitário da tonelada do Fertilizante Potássico'],
            ['name' => 'fertilizante_nitrogenado', 'label' => 'Custo unitário da tonelada do Fertilizante Nitrogenado:', 'placeholder' => 'Digite o custo unitário da tonelada do Fertilizante Nitrogenado'],
            ['name' => 'micronutrientes', 'label' => 'Custo unitário da tonelada dos Micronutrientes:', 'placeholder' => 'Digite o custo unitário da tonelada dos Micronutrientes'],
            ['name' => 'depreciacao_tratores', 'label' => 'Custo untário de 1 Trator Agrícola:', 'placeholder' => 'Digite o Custo untário de 1 Trator Agrícola'],
            ['name' => 'depreciacao_grades_aradoras', 'label' => 'Custo untário de 1 Grade Aradora:', 'placeholder' => 'Digite o Custo untário de 1 Grade Aradora'],
            ['name' => 'depreciacao_adubadoras', 'label' => 'Custo untário de 1 Adubadora:', 'placeholder' => 'Digite o Custo untário de 1 Adubadora'],
            ['name' => 'depreciacao_caminhoes', 'label' => 'Custo untário de 1 Caminhão:', 'placeholder' => 'Digite o Custo untário de 1 Caminhão'],
            ['name' => 'combustivel', 'label' => 'Custo unitário do litro de combustível:', 'placeholder' => 'Digite o Custo unitário do litro de combustível'],
            ['name' => 'manutencao_preventiva', 'label' => 'Custo unitário das Manutenções Preventivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Preventivas'],
            ['name' => 'manutencao_corretiva', 'label' => 'Custo unitário das Manutenções Corretivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Corretivas'],
            
            // Custo unitário da hora para trabalhadores
            ['name' => 'operadores_tratores', 'label' => 'Custo unitário da hora para Operadores de Tratores Agrícolas:', 'placeholder' => 'Digite o custo unitário da hora para Operadores de Tratores Agrícolas'],
            ['name' => 'trabalhadores_agricolas', 'label' => 'Custo unitário da hora para Trabalhadores Agrícolas (Auxiliares):', 'placeholder' => 'Digite o custo unitário da hora para Trabalhadores Agrícolas (Auxiliares)'],
            ['name' => 'tecnico_agricola', 'label' => 'Custo unitário da hora para Técnicos Agrícolas:', 'placeholder' => 'Digite o custo unitário da hora para Técnicos Agrícolas'],
            ['name' => 'tecnico_mecanizacao', 'label' => 'Custo unitário da hora para Técnicos em Mecanização Agrícola:', 'placeholder' => 'Digite o custo unitário da hora para Técnicos em Mecanização Agrícola'],
            ['name' => 'supervisor_campo', 'label' => 'Custo unitário da hora para Supervisores de Campo:', 'placeholder' => 'Digite o custo unitário da hora para Supervisores de Campo'],
            ['name' => 'supervisor_admin', 'label' => 'Custo unitário da hora para Supervisores/Admin:', 'placeholder' => 'Digite o custo unitário da hora para Supervisores/Admin'],
            ['name' => 'motoristas_caminhao', 'label' => 'Custo unitário da hora para 1 Motorista de Caminhão:', 'placeholder' => 'Digite o custo unitário da hora para 1 Motorista de Caminhão'],
        ],
        'aplicacao' => [
             // Inputs de calcário e gesso agrícola
             ['name' => 'calcario', 'label' => 'Custo unitário da tonelada do Calcário:', 'placeholder' => 'Digite o custo unitário da tonelada do Calcário'],
             ['name' => 'gesso_agricola', 'label' => 'Custo unitário da tonelada do Gesso Agrícola:', 'placeholder' => 'Digite o custo unitário  da tonelada do Gesso Agrícola (a lanço)'],
             
             // Inputs de combustíveis e manutenção
             ['name' => 'combustivel', 'label' => 'Custo unitário do litro de combustível:', 'placeholder' => 'Digite o Custo unitário do litro de combustível'],
             ['name' => 'manutencao_preventiva', 'label' => 'Custo unitário das Manutenções Preventivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Preventivas'],
             ['name' => 'manutencao_corretiva', 'label' => 'Custo unitário das Manutenções Corretivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Corretivas'],
             ['name' => 'depreciacao_tratores', 'label' => 'Custo untário de 1 Trator Agrícola:', 'placeholder' => 'Digite o Custo untário de 1 Trator Agrícola'],
             ['name' => 'depreciacao_grades_aradoras', 'label' => 'Custo untário de 1 Grade Aradora:', 'placeholder' => 'Digite o Custo untário de 1 Grade Aradora'],
             ['name' => 'depreciacao_distribuidor_calcario', 'label' => 'Custo untário de 1 Distribuidor de calcário gesso agrícola:', 'placeholder' => 'Digite o Custo untário de 1 Distribuidor de calcário gesso agrícola'],
             ['name' => 'depreciacao_caminhoes', 'label' => 'Custo untário de 1 Caminhão:', 'placeholder' => 'Digite o Custo untário de 1 Caminhão'],


             // Inputs de mão de obra
             ['name' => 'tecnico_agricola', 'label' => 'Custo unitário da hora para 1 Técnico Agrícola:', 'placeholder' => 'Digite o custo unitário da hora para 1 Técnico Agrícola'],
             ['name' => 'operador_trator', 'label' => 'Custo unitário da hora para 1 Operador de Tratores Agrícolas:', 'placeholder' => 'Digite o custo unitário da hora para 1 Operador de Tratores Agrícolas'],
             ['name' => 'auxiliares_operacao', 'label' => 'Custo unitário da hora para 1 Auxiliares de Operação (de Tratoristas):', 'placeholder' => 'Digite o custo unitário da hora para 1 Auxiliares de Operação'],
             ['name' => 'motorista_caminhao', 'label' => 'Custo unitário da hora para 1 Motorista de Caminhão (Transporte de Corretivos):', 'placeholder' => 'Digite o custo unitário da hora para 1 Motorista de Caminhão'],
             ['name' => 'mao_de_obra_aplicacao', 'label' => 'Custo unitário da hora para a mão de obra de Manuseio e Aplicação Manual:', 'placeholder' => 'Digite o custo unitário da hora para a mão de obra de Manuseio e Aplicação Manual'],
         ],
        'plantio' => [
            // Inputs de sementes, fertilizantes e água
            ['name' => 'sementes_amendoim', 'label' => 'Custo unitário da tonelada da Semente de Amendoim:', 'placeholder' => 'Digite o custo unitário da tonelada da Semente de Amendoim'],
            ['name' => 'fertilizante_nitrogenio', 'label' => 'Custo unitário da tonelada do Fertilizante Nitrogênio:', 'placeholder' => 'Digite o custo unitário da tonelada do Fertilizante Nitrogênio'],
            ['name' => 'fertilizante_fosforo', 'label' => 'Custo unitário da tonelada do Fertilizante Fósforo:', 'placeholder' => 'Digite o custo unitário da tonelada do Fertilizante Fósforo'],
            ['name' => 'fertilizante_potassio', 'label' => 'Custo unitário da tonelada do Fertilizante Potássio:', 'placeholder' => 'Digite o custo unitário da tonelada do Fertilizante Potássio'],
            ['name' => 'agua', 'label' => 'Custo unitário do metro cúbico de Água:', 'placeholder' => 'Digite o custo unitário do metro cúbico de Água'],

            // Inputs de combustíveis e manutenção
            ['name' => 'combustivel', 'label' => 'Custo unitário do litro de combustível:', 'placeholder' => 'Digite o Custo unitário do litro de combustível'],
            ['name' => 'manutencao_preventiva', 'label' => 'Custo unitário das Manutenções Preventivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Preventivas'],
            ['name' => 'manutencao_corretiva', 'label' => 'Custo unitário das Manutenções Corretivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Corretivas'],
            ['name' => 'depreciacao_tratores', 'label' => 'Custo untário de 1 Trator Agrícola:', 'placeholder' => 'Digite o Custo untário de 1 Trator Agrícola'],
            ['name' => 'depreciacao_plantadeira', 'label' => 'Custo untário de 1 Plantadeira de precisão:', 'placeholder' => 'Digite o Custo untário de 1 Plantadeira de precisão'],
            ['name' => 'depreciacao_caminhoes', 'label' => 'Custo untário de 1 Caminhão:', 'placeholder' => 'Digite o Custo untário de 1 Caminhão'],

            // Inputs de mão de obra
            ['name' => 'tecnico_agricola', 'label' => 'Custo unitário da hora para 1 Técnico Agrícola:', 'placeholder' => 'Digite o custo unitário da hora para 1 Técnico Agrícola'],
            ['name' => 'operador_trator', 'label' => 'Custo unitário da hora para 1 Operador de Trator Agrícola:', 'placeholder' => 'Digite o custo unitário da hora para 1 Operador de Trator Agrícola'],
            ['name' => 'auxiliares_operacao', 'label' => 'Custo unitário da hora para 1 Auxiliar de Operação (de Tratoristas):', 'placeholder' => 'Digite o custo unitário da hora para 1 Auxiliar de Operação'],
            ['name' => 'motorista_caminhao', 'label' => 'Custo unitário da hora para 1 Motorista de Caminhão:', 'placeholder' => 'Digite o custo unitário da hora para 1 Motorista de Caminhão'],
            ],        
        'manejo' => [
            // Inputs de pulverização e fertilizantes
            ['name' => 'pulverizacao_autopropelido', 'label' => 'Custo unitário da Pulverização com Autopropelido:', 'placeholder' => 'Digite o custo unitário da Pulverização com Autopropelido'],
            ['name' => 'pulverizacao_arrasto', 'label' => 'Custo unitário da Pulverização com Pulverizador de Arrasto/Hidráulico:', 'placeholder' => 'Digite o custo unitário da Pulverização com Pulverizador de Arrasto/Hidráulico'],
            ['name' => 'fertilizante_nitrogenio_pos', 'label' => 'Custo unitário do quilo do Fertilizante Nitrogênio (pós-plantio):', 'placeholder' => 'Digite o custo unitário do quilo do Fertilizante Nitrogênio (pós-plantio)'],
            ['name' => 'fertilizante_fosforo_pos', 'label' => 'Custo unitário do quilo do Fertilizante Fósforo (pós-plantio):', 'placeholder' => 'Digite o custo unitário do quilo do Fertilizante Fósforo (pós-plantio)'],
            ['name' => 'fertilizante_potassio_pos', 'label' => 'Custo unitário do quilo do Fertilizante Potássio (pós-plantio):', 'placeholder' => 'Digite o custo unitário do quilo do Fertilizante Potássio (pós-plantio)'],
            ['name' => 'micronutrientes_pos', 'label' => 'Custo unitário do quilo dos Micronutrientes (pós-plantio):', 'placeholder' => 'Digite o custo unitário do quilo dos Micronutrientes (pós-plantio)'],
            ['name' => 'inseticidas', 'label' => 'Custo unitário da aplicação dos Inseticidas (manejo sanitário):', 'placeholder' => 'Digite o custo unitário da aplicação dos Inseticidas (manejo sanitário)'],
            ['name' => 'fungicidas', 'label' => 'Custo unitário da aplicação dos Fungicidas (manejo sanitário):', 'placeholder' => 'Digite o custo unitário da aplicação dos Fungicidas (manejo sanitário)'],
            ['name' => 'herbicidas', 'label' => 'Custo unitário da aplicação dos Herbicidas (manejo sanitário):', 'placeholder' => 'Digite o custo unitário da aplicação dos Herbicidas (manejo sanitário)'],
            
            // Inputs de combustíveis e manutenção
            ['name' => 'combustivel', 'label' => 'Custo unitário do litro de combustível:', 'placeholder' => 'Digite o Custo unitário do litro de combustível'],
            ['name' => 'manutencao_preventiva', 'label' => 'Custo unitário das Manutenções Preventivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Preventivas'],
            ['name' => 'manutencao_corretiva', 'label' => 'Custo unitário das Manutenções Corretivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Corretivas'],
            ['name' => 'depreciacao_tratores', 'label' => 'Custo untário de 1 Trator Agrícola:', 'placeholder' => 'Digite o Custo untário de 1 Trator Agrícola'],
            ['name' => 'depreciacao_pulverizador', 'label' => 'Custo untário de 1 Pulverizador:', 'placeholder' => 'Digite o Custo untário de 1 Pulverizador'],
            ['name' => 'depreciacao_distribuidora_fertilizantes', 'label' => 'Custo untário de 1 Distribuidora de fertilizantes:', 'placeholder' => 'Digite o Custo untário de 1 Distribuidora de fertilizantes'],
            ['name' => 'depreciacao_distribuidora_corretivos', 'label' => 'Custo untário de 1 Distribuidora de corretivos:', 'placeholder' => 'Digite o Custo untário de 1 Distribuidora de corretivos'],
            ['name' => 'depreciacao_caminhoes', 'label' => 'Custo untário de 1 Caminhão:', 'placeholder' => 'Digite o Custo untário de 1 Caminhão'],

            // Inputs de mão de obra
            ['name' => 'tecnico_agricola', 'label' => 'Custo unitário da hora para 1 Técnico Agrícola:', 'placeholder' => 'Digite o custo unitário da hora para 1 Técnico Agrícola'],
            ['name' => 'operador_trator', 'label' => 'Custo unitário da hora para 1 Operador de Tratores Agrícolas:', 'placeholder' => 'Digite o custo unitário da hora para 1 Operador de Tratores Agrícolas'],
            ['name' => 'auxiliares_operacao', 'label' => 'Custo unitário da hora para 1 Auxiliares de Operação (de Tratoristas):', 'placeholder' => 'Digite o custo unitário da hora para 1 Auxiliares de Operação'],
            ['name' => 'motorista_caminhao', 'label' => 'Custo unitário da hora para 1 Motorista de Caminhão (Transporte de Corretivos):', 'placeholder' => 'Digite o custo unitário da hora para 1 Motorista de Caminhão'],
            ['name' => 'mao_de_obra_aplicacao', 'label' => 'Custo unitário da hora para a mão de obra de Manuseio e Aplicação Manual:', 'placeholder' => 'Digite o custo unitário da hora para a mão de obra de Manuseio e Aplicação Manual'],
        ],
        'colheita' => [
            ['name' => 'combustivel', 'label' => 'Custo unitário do litro de combustível:', 'placeholder' => 'Digite o Custo unitário do litro de combustível'],
            ['name' => 'manutencao_preventiva', 'label' => 'Custo unitário das Manutenções Preventivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Preventivas'],
            ['name' => 'manutencao_corretiva', 'label' => 'Custo unitário das Manutenções Corretivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Corretivas'],
            ['name' => 'depreciacao_caminhoes', 'label' => 'Custo unitário de 1 Caminhão:', 'placeholder' => 'Digite o custo unitário de 1 Caminhão'],
            ['name' => 'depreciacao_colhedora', 'label' => 'Custo unitário de 1 Colhedora:', 'placeholder' => 'Digite custo unitário de 1 Colhedora'],
            ['name' => 'operador_colhedora', 'label' => 'Custo unitário da hora para 1 Operador de Colhedora:', 'placeholder' => 'Digite o custo unitário da hora para 1 Operador de Colhedora'],
            ['name' => 'auxiliares_colhedora', 'label' => 'Custo unitário da hora para 1 Auxiliar de Operador de Colhedora:', 'placeholder' => 'Digite o custo unitário da hora para 1 Auxiliar de Operador de Colhedora'],
            ['name' => 'tecnico_agricola', 'label' => 'Custo unitário da hora para 1 Técnico Agrícola:', 'placeholder' => 'Digite o custo unitário da hora para 1 Técnico Agrícola'],
            ['name' => 'manuseador_carregador', 'label' => 'Custo unitário da hora para 1 Manuseador e Carregador de Produtos:', 'placeholder' => 'Digite o custo unitário da hora para 1 Manuseador e Carregador de Produtos'],
            ['name' => 'motoristas_caminhao', 'label' => 'Custo unitário da hora para 1 Motorista de Caminhão:', 'placeholder' => 'Digite o custo unitário da hora para 1 Motorista de Caminhão'],  
        ],
    ];

    protected $sectionInputsSoja = [
        'preparo' => [
            ['name' => 'gradagem_pesada', 'label' => 'Custo unitário da passagem da Gradagem Pesada:', 'placeholder' => 'Digite o custo unitário da passagem da Gradagem Pesada'],
            ['name' => 'aracao_iveca', 'label' => 'Custo unitário da passagem da Aração (Iveca):', 'placeholder' => 'Digite o custo unitário da passagem da Aração (Iveca)'],
            ['name' => 'gradagem_intermediaria', 'label' => 'Custo unitário da passagem da Gradagem Intermediária:', 'placeholder' => 'Digite o custo unitário da passagem da Gradagem Intermediária'],
            ['name' => 'gradagem_niveladora', 'label' => 'Custo unitário da passagem da Gradagem Niveladora:', 'placeholder' => 'Digite o custo unitário da passagem da Gradagem Niveladora'],
            ['name' => 'canteirizacao', 'label' => 'Custo unitário da passagem da Enxada Rotativa (Canteirização):', 'placeholder' => 'Digite o custo unitário da passagem da Enxada Rotativa (Canteirização)'],
            ['name' => 'subsolagem', 'label' => 'Custo unitário da passagem da Subsolagem:', 'placeholder' => 'Digite o custo unitário da passagem da Subsolagem'],
            ['name' => 'pulverizacao_dessecacao', 'label' => 'Custo unitário da aplicação da Pulverização de Dessecação Pré-Plantio:', 'placeholder' => 'Digite o custo unitário da aplicação da Pulverização de Dessecação Pré-Plantio'],
            ['name' => 'calcario', 'label' => 'Custo unitário da tonelada do Calcário:', 'placeholder' => 'Digite o custo unitário da tonelada do Calcário'],
            ['name' => 'fertilizante_fosfatado', 'label' => 'Custo unitário da tonelada do Fertilizante Fosfatado:', 'placeholder' => 'Digite o custo unitário da tonelada do Fertilizante Fosfatado'],
            ['name' => 'fertilizante_potassico', 'label' => 'Custo unitário da tonelada do Fertilizante Potássico:', 'placeholder' => 'Digite o custo unitário da tonelada do Fertilizante Potássico'],
            ['name' => 'fertilizante_nitrogenado', 'label' => 'Custo unitário da tonelada do Fertilizante Nitrogenado:', 'placeholder' => 'Digite o custo unitário da tonelada do Fertilizante Nitrogenado'],
            ['name' => 'micronutrientes', 'label' => 'Custo unitário da tonelada dos Micronutrientes:', 'placeholder' => 'Digite o custo unitário da tonelada dos Micronutrientes'],
            ['name' => 'depreciacao_tratores', 'label' => 'Custo untário de 1 Trator Agrícola:', 'placeholder' => 'Digite o Custo untário de 1 Trator Agrícola'],
            ['name' => 'depreciacao_grades_aradoras', 'label' => 'Custo untário de 1 Grade Aradora:', 'placeholder' => 'Digite o Custo untário de 1 Grade Aradora'],
            ['name' => 'depreciacao_adubadoras', 'label' => 'Custo untário de 1 Adubadora:', 'placeholder' => 'Digite o Custo untário de 1 Adubadora'],
            ['name' => 'depreciacao_caminhoes', 'label' => 'Custo untário de 1 Caminhão:', 'placeholder' => 'Digite o Custo untário de 1 Caminhão'],
            ['name' => 'combustivel', 'label' => 'Custo unitário do litro de combustível:', 'placeholder' => 'Digite o Custo unitário do litro de combustível'],
            ['name' => 'manutencao_preventiva', 'label' => 'Custo unitário das Manutenções Preventivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Preventivas'],
            ['name' => 'manutencao_corretiva', 'label' => 'Custo unitário das Manutenções Corretivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Corretivas'],
            
            // Custo unitário da hora para trabalhadores
            ['name' => 'operadores_tratores', 'label' => 'Custo unitário da hora para Operadores de Tratores Agrícolas:', 'placeholder' => 'Digite o custo unitário da hora para Operadores de Tratores Agrícolas'],
            ['name' => 'trabalhadores_agricolas', 'label' => 'Custo unitário da hora para Trabalhadores Agrícolas (Auxiliares):', 'placeholder' => 'Digite o custo unitário da hora para Trabalhadores Agrícolas (Auxiliares)'],
            ['name' => 'tecnico_agricola', 'label' => 'Custo unitário da hora para Técnicos Agrícolas:', 'placeholder' => 'Digite o custo unitário da hora para Técnicos Agrícolas'],
            ['name' => 'tecnico_mecanizacao', 'label' => 'Custo unitário da hora para Técnicos em Mecanização Agrícola:', 'placeholder' => 'Digite o custo unitário da hora para Técnicos em Mecanização Agrícola'],
            ['name' => 'supervisor_campo', 'label' => 'Custo unitário da hora para Supervisores de Campo:', 'placeholder' => 'Digite o custo unitário da hora para Supervisores de Campo'],
            ['name' => 'supervisor_admin', 'label' => 'Custo unitário da hora para Supervisores/Admin:', 'placeholder' => 'Digite o custo unitário da hora para Supervisores/Admin'],
            ['name' => 'motoristas_caminhao', 'label' => 'Custo unitário da hora para 1 Motorista de Caminhão:', 'placeholder' => 'Digite o custo unitário da hora para 1 Motorista de Caminhão'],
        ],
        'aplicacao' => [
             // Inputs de calcário e gesso agrícola
             ['name' => 'calcario', 'label' => 'Custo unitário da tonelada do Calcário:', 'placeholder' => 'Digite o custo unitário da tonelada do Calcário'],
             ['name' => 'gesso_agricola', 'label' => 'Custo unitário da tonelada do Gesso Agrícola:', 'placeholder' => 'Digite o custo unitário  da tonelada do Gesso Agrícola (a lanço)'],
             
             // Inputs de combustíveis e manutenção
             ['name' => 'combustivel', 'label' => 'Custo unitário do litro de combustível:', 'placeholder' => 'Digite o Custo unitário do litro de combustível'],
             ['name' => 'manutencao_preventiva', 'label' => 'Custo unitário das Manutenções Preventivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Preventivas'],
             ['name' => 'manutencao_corretiva', 'label' => 'Custo unitário das Manutenções Corretivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Corretivas'],
             ['name' => 'depreciacao_tratores', 'label' => 'Custo untário de 1 Trator Agrícola:', 'placeholder' => 'Digite o Custo untário de 1 Trator Agrícola'],
             ['name' => 'depreciacao_grades_aradoras', 'label' => 'Custo untário de 1 Grade Aradora:', 'placeholder' => 'Digite o Custo untário de 1 Grade Aradora'],
             ['name' => 'depreciacao_distribuidor_calcario', 'label' => 'Custo untário de 1 Distribuidor de calcário gesso agrícola:', 'placeholder' => 'Digite o Custo untário de 1 Distribuidor de calcário gesso agrícola'],
             ['name' => 'depreciacao_caminhoes', 'label' => 'Custo untário de 1 Caminhão:', 'placeholder' => 'Digite o Custo untário de 1 Caminhão'],


             // Inputs de mão de obra
             ['name' => 'tecnico_agricola', 'label' => 'Custo unitário da hora para 1 Técnico Agrícola:', 'placeholder' => 'Digite o custo unitário da hora para 1 Técnico Agrícola'],
             ['name' => 'operador_trator', 'label' => 'Custo unitário da hora para 1 Operador de Tratores Agrícolas:', 'placeholder' => 'Digite o custo unitário da hora para 1 Operador de Tratores Agrícolas'],
             ['name' => 'auxiliares_operacao', 'label' => 'Custo unitário da hora para 1 Auxiliares de Operação (de Tratoristas):', 'placeholder' => 'Digite o custo unitário da hora para 1 Auxiliares de Operação'],
             ['name' => 'motorista_caminhao', 'label' => 'Custo unitário da hora para 1 Motorista de Caminhão (Transporte de Corretivos):', 'placeholder' => 'Digite o custo unitário da hora para 1 Motorista de Caminhão'],
             ['name' => 'mao_de_obra_aplicacao', 'label' => 'Custo unitário da hora para a mão de obra de Manuseio e Aplicação Manual:', 'placeholder' => 'Digite o custo unitário da hora para a mão de obra de Manuseio e Aplicação Manual'],
         ],
        'plantio' => [
            // Inputs de sementes, fertilizantes e água
            ['name' => 'sementes_amendoim', 'label' => 'Custo unitário da tonelada da Semente de Amendoim:', 'placeholder' => 'Digite o custo unitário da tonelada da Semente de Amendoim'],
            ['name' => 'fertilizante_nitrogenio', 'label' => 'Custo unitário da tonelada do Fertilizante Nitrogênio:', 'placeholder' => 'Digite o custo unitário da tonelada do Fertilizante Nitrogênio'],
            ['name' => 'fertilizante_fosforo', 'label' => 'Custo unitário da tonelada do Fertilizante Fósforo:', 'placeholder' => 'Digite o custo unitário da tonelada do Fertilizante Fósforo'],
            ['name' => 'fertilizante_potassio', 'label' => 'Custo unitário da tonelada do Fertilizante Potássio:', 'placeholder' => 'Digite o custo unitário da tonelada do Fertilizante Potássio'],
            ['name' => 'agua', 'label' => 'Custo unitário do metro cúbico de Água:', 'placeholder' => 'Digite o custo unitário do metro cúbico de Água'],

            // Inputs de combustíveis e manutenção
            ['name' => 'combustivel', 'label' => 'Custo unitário do litro de combustível:', 'placeholder' => 'Digite o Custo unitário do litro de combustível'],
            ['name' => 'manutencao_preventiva', 'label' => 'Custo unitário das Manutenções Preventivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Preventivas'],
            ['name' => 'manutencao_corretiva', 'label' => 'Custo unitário das Manutenções Corretivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Corretivas'],
            ['name' => 'depreciacao_tratores', 'label' => 'Custo untário de 1 Trator Agrícola:', 'placeholder' => 'Digite o Custo untário de 1 Trator Agrícola'],
            ['name' => 'depreciacao_plantadeira', 'label' => 'Custo untário de 1 Plantadeira de precisão:', 'placeholder' => 'Digite o Custo untário de 1 Plantadeira de precisão'],
            ['name' => 'depreciacao_caminhoes', 'label' => 'Custo untário de 1 Caminhão:', 'placeholder' => 'Digite o Custo untário de 1 Caminhão'],

            // Inputs de mão de obra
            ['name' => 'tecnico_agricola', 'label' => 'Custo unitário da hora para 1 Técnico Agrícola:', 'placeholder' => 'Digite o custo unitário da hora para 1 Técnico Agrícola'],
            ['name' => 'operador_trator', 'label' => 'Custo unitário da hora para 1 Operador de Trator Agrícola:', 'placeholder' => 'Digite o custo unitário da hora para 1 Operador de Trator Agrícola'],
            ['name' => 'auxiliares_operacao', 'label' => 'Custo unitário da hora para 1 Auxiliar de Operação (de Tratoristas):', 'placeholder' => 'Digite o custo unitário da hora para 1 Auxiliar de Operação'],
            ['name' => 'motorista_caminhao', 'label' => 'Custo unitário da hora para 1 Motorista de Caminhão:', 'placeholder' => 'Digite o custo unitário da hora para 1 Motorista de Caminhão'],
            ],        
        'manejo' => [
            // Inputs de pulverização e fertilizantes
            ['name' => 'pulverizacao_autopropelido', 'label' => 'Custo unitário da Pulverização com Autopropelido:', 'placeholder' => 'Digite o custo unitário da Pulverização com Autopropelido'],
            ['name' => 'pulverizacao_arrasto', 'label' => 'Custo unitário da Pulverização com Pulverizador de Arrasto/Hidráulico:', 'placeholder' => 'Digite o custo unitário da Pulverização com Pulverizador de Arrasto/Hidráulico'],
            ['name' => 'fertilizante_nitrogenio_pos', 'label' => 'Custo unitário do quilo do Fertilizante Nitrogênio (pós-plantio):', 'placeholder' => 'Digite o custo unitário do quilo do Fertilizante Nitrogênio (pós-plantio)'],
            ['name' => 'fertilizante_fosforo_pos', 'label' => 'Custo unitário do quilo do Fertilizante Fósforo (pós-plantio):', 'placeholder' => 'Digite o custo unitário do quilo do Fertilizante Fósforo (pós-plantio)'],
            ['name' => 'fertilizante_potassio_pos', 'label' => 'Custo unitário do quilo do Fertilizante Potássio (pós-plantio):', 'placeholder' => 'Digite o custo unitário do quilo do Fertilizante Potássio (pós-plantio)'],
            ['name' => 'micronutrientes_pos', 'label' => 'Custo unitário do quilo dos Micronutrientes (pós-plantio):', 'placeholder' => 'Digite o custo unitário do quilo dos Micronutrientes (pós-plantio)'],
            ['name' => 'inseticidas', 'label' => 'Custo unitário da aplicação dos Inseticidas (manejo sanitário):', 'placeholder' => 'Digite o custo unitário da aplicação dos Inseticidas (manejo sanitário)'],
            ['name' => 'fungicidas', 'label' => 'Custo unitário da aplicação dos Fungicidas (manejo sanitário):', 'placeholder' => 'Digite o custo unitário da aplicação dos Fungicidas (manejo sanitário)'],
            ['name' => 'herbicidas', 'label' => 'Custo unitário da aplicação dos Herbicidas (manejo sanitário):', 'placeholder' => 'Digite o custo unitário da aplicação dos Herbicidas (manejo sanitário)'],
            
            // Inputs de combustíveis e manutenção
            ['name' => 'combustivel', 'label' => 'Custo unitário do litro de combustível:', 'placeholder' => 'Digite o Custo unitário do litro de combustível'],
            ['name' => 'manutencao_preventiva', 'label' => 'Custo unitário das Manutenções Preventivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Preventivas'],
            ['name' => 'manutencao_corretiva', 'label' => 'Custo unitário das Manutenções Corretivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Corretivas'],
            ['name' => 'depreciacao_tratores', 'label' => 'Custo untário de 1 Trator Agrícola:', 'placeholder' => 'Digite o Custo untário de 1 Trator Agrícola'],
            ['name' => 'depreciacao_pulverizador', 'label' => 'Custo untário de 1 Pulverizador:', 'placeholder' => 'Digite o Custo untário de 1 Pulverizador'],
            ['name' => 'depreciacao_distribuidora_fertilizantes', 'label' => 'Custo untário de 1 Distribuidora de fertilizantes:', 'placeholder' => 'Digite o Custo untário de 1 Distribuidora de fertilizantes'],
            ['name' => 'depreciacao_distribuidora_corretivos', 'label' => 'Custo untário de 1 Distribuidora de corretivos:', 'placeholder' => 'Digite o Custo untário de 1 Distribuidora de corretivos'],
            ['name' => 'depreciacao_caminhoes', 'label' => 'Custo untário de 1 Caminhão:', 'placeholder' => 'Digite o Custo untário de 1 Caminhão'],

            // Inputs de mão de obra
            ['name' => 'tecnico_agricola', 'label' => 'Custo unitário da hora para 1 Técnico Agrícola:', 'placeholder' => 'Digite o custo unitário da hora para 1 Técnico Agrícola'],
            ['name' => 'operador_trator', 'label' => 'Custo unitário da hora para 1 Operador de Tratores Agrícolas:', 'placeholder' => 'Digite o custo unitário da hora para 1 Operador de Tratores Agrícolas'],
            ['name' => 'auxiliares_operacao', 'label' => 'Custo unitário da hora para 1 Auxiliares de Operação (de Tratoristas):', 'placeholder' => 'Digite o custo unitário da hora para 1 Auxiliares de Operação'],
            ['name' => 'motorista_caminhao', 'label' => 'Custo unitário da hora para 1 Motorista de Caminhão (Transporte de Corretivos):', 'placeholder' => 'Digite o custo unitário da hora para 1 Motorista de Caminhão'],
            ['name' => 'mao_de_obra_aplicacao', 'label' => 'Custo unitário da hora para a mão de obra de Manuseio e Aplicação Manual:', 'placeholder' => 'Digite o custo unitário da hora para a mão de obra de Manuseio e Aplicação Manual'],
        ],
        'colheita' => [
            ['name' => 'combustivel', 'label' => 'Custo unitário do litro de combustível:', 'placeholder' => 'Digite o Custo unitário do litro de combustível'],
            ['name' => 'manutencao_preventiva', 'label' => 'Custo unitário das Manutenções Preventivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Preventivas'],
            ['name' => 'manutencao_corretiva', 'label' => 'Custo unitário das Manutenções Corretivas:', 'placeholder' => 'Digite o custo unitário das Manutenções Corretivas'],
            ['name' => 'depreciacao_caminhoes', 'label' => 'Custo unitário de 1 Caminhão:', 'placeholder' => 'Digite o custo unitário de 1 Caminhão'],
            ['name' => 'depreciacao_colhedora', 'label' => 'Custo unitário de 1 Colhedora:', 'placeholder' => 'Digite custo unitário de 1 Colhedora'],
            ['name' => 'operador_colhedora', 'label' => 'Custo unitário da hora para 1 Operador de Colhedora:', 'placeholder' => 'Digite o custo unitário da hora para 1 Operador de Colhedora'],
            ['name' => 'auxiliares_colhedora', 'label' => 'Custo unitário da hora para 1 Auxiliar de Operador de Colhedora:', 'placeholder' => 'Digite o custo unitário da hora para 1 Auxiliar de Operador de Colhedora'],
            ['name' => 'tecnico_agricola', 'label' => 'Custo unitário da hora para 1 Técnico Agrícola:', 'placeholder' => 'Digite o custo unitário da hora para 1 Técnico Agrícola'],
            ['name' => 'manuseador_carregador', 'label' => 'Custo unitário da hora para 1 Manuseador e Carregador de Produtos:', 'placeholder' => 'Digite o custo unitário da hora para 1 Manuseador e Carregador de Produtos'],
            ['name' => 'motoristas_caminhao', 'label' => 'Custo unitário da hora para 1 Motorista de Caminhão:', 'placeholder' => 'Digite o custo unitário da hora para 1 Motorista de Caminhão'],  
        ],
    ];

    public function getInputsAmendoim(Request $request)
    {
        $selectedSections = $request->input('sections', []);
        
        $inputs = [];
        foreach ($selectedSections as $section) {
            if (isset($this->sectionInputsAmendoim[$section])) {
                $inputs = array_merge($inputs, $this->sectionInputsAmendoim[$section]);
            }
        }

        $inputs = $this->removeDuplicateInputs($inputs);

        return response()->json(['inputs' => $inputs]);
    }

    public function getInputsSoja(Request $request)
    {
        $selectedSections = $request->input('sections', []);
        $inputs = [];
        foreach ($selectedSections as $section) {
            if (isset($this->sectionInputsSoja[$section])) {
                $inputs = array_merge($inputs, $this->sectionInputsSoja[$section]);
            }
        }

        $inputs = $this->removeDuplicateInputs($inputs);

        return response()->json(['inputs' => $inputs]);
    }

    protected function removeDuplicateInputs($inputs)
    {
        $uniqueInputs = [];
        $addedNames = [];

        foreach ($inputs as $input) {
            if (!in_array($input['name'], $addedNames)) {
                $uniqueInputs[] = $input;
                $addedNames[] = $input['name'];
            }
        }

        return $uniqueInputs;
    }
}
