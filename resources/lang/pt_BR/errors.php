<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Error Message Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the Laravel Responder package.
    | When it generates error responses, it will search the messages array
    | below for any key matching the given error code for the response.
    |
    */
    'validation_user_password_failed' => 'As informações de login e senha estão inválidas.',
    'unauthenticated' => 'Você não está autenticado para esta solicitação.',
    'unauthorized' => 'Você não está autorizado para esta solicitação.',
    'page_not_found' => 'A página requisitada não existe.',
    'resource_not_found' => 'O recurso requisitado não existe.',
    'relation_not_found' => 'A relação solicitada não existe.',
    'validation_failed' => 'Os dados fornecidos falharam na aprovação na validação.',
    'store_failed' => 'Ocorreu uma falha ao gravar os dados fornecidos.',
    /**
     * Errors customs
     */
    '403' => 'Você não está autorizado para realizar esta ação. Em caso de dúvida entre em contato com os administradores do sistema.',
    '404' => 'Não foi possível encontrar esta requisição pelo sistema.',
    '419' => 'Sua sessão foi expirada ou inativada. Tente entrar no sistema novamente.',
    '429' => 'Ocorreu um excesso de requisições ao sistema. Limite máximo permitido por usuário de 50 pedidos por hora. Tente novamente em breve.',
    '500' => 'Ocorreu um erro interno no sistema. Tente novamente em breve.',
    '502' => 'Este acesso está restrito somente para o administrador de sistema. <br>Em caso de dúvida entre em contato com os administradores do sistema.',
    '503' => 'O sistema encontra-se em manutenção. Dentro de alguns minutos entrará em funcionamento. Em caso de dúvida entre em contato com os administradores do sistema.',
];
