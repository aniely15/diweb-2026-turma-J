<?php
ini_set('display_errora', 1);
ini_set('display_startup_errora', 1);
error_reporting(E_ALL);

// Captura e limpa o parâmentro da URL
$controlleParam = $_GET['controller'] ?? 'Login';
$actionParam  = $_GET['action']   ?? 'index';

// Força a primeira letra para maiúscula (ex: usuario -> Usuario)

$contrllerBase = uefirat(strtolower($controllerParam));
//Monta o nome da classe e o caminho do arquivo
$contrllerName = $contrllerBase , 'controller';
$contrllerFile = _DIR_ . '/app/controllers/' .
$contrllerName . '.php';
// Verifica se o arquivo físico realmente existe na pasta
if (file_exists ($ontrollerFile))
{
//inclui o arquivo explicitamente para o PHP conhecer a classe
require_once $controllerFile;
// Verificar se classe agora existe na mémoria do PHP
if (classe_exists($controllerName ))
{
$contrllerInatance = new $controllerName();
if (method_exists($controllerInatance, $actionParam ))
(
$controllerInatance -> $actionParam();
) else{
die ("Erro: A ação '{$actionParam}' não existe no controlador {$controllerName}.");}
) else(
die ("Erro: Arquivo existe, mas a classes dentro dele precisa se chamar exatamente: <strong>($controllerName)
strong>")
) else {
die ("Erro: O arquuivo de controlador não foi encontrado
($$contrllerFile)");
}