<?php
// Definição de constantes para login
const USUARIO = 'Everthon';
const SENHA = '#Vocenaosabe';
const INVENTARIO_ARQUIVO = 'inventario.txt';

// Função para verificar login
function verificarLogin($usuario, $senha) 
{
return $usuario === USUARIO && $senha === SENHA;
}
?>
