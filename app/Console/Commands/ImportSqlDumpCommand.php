<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;
use PDOException;

class ImportSqlDumpCommand extends Command
{
    protected $signature = 'db:import-sql
                            {path : Caminho absoluto ou relativo ao ficheiro .sql}
                            {--force : Executar sem confirmação (apaga e recria a base)}';

    protected $description = 'Recria a base de dados MySQL e importa um dump SQL (multi-statement).';

    public function handle(): int
    {
        $relativeBase = base_path(trim($this->argument('path'), '"\''));

        $path = file_exists($relativeBase)
            ? $relativeBase
            : $this->argument('path');

        if (! is_readable($path)) {
            $this->error("Ficheiro não encontrado ou sem leitura: {$path}");

            return self::FAILURE;
        }

        if (! $this->option('force')) {
            if (! $this->confirm('Isto vai APAGAR a base de dados atual e repor a partir do SQL. Continuar?', false)) {
                $this->info('Cancelado.');

                return self::SUCCESS;
            }
        }

        $host = config('database.connections.mysql.host', '127.0.0.1');
        $port = (int) config('database.connections.mysql.port', 3306);
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = (string) config('database.connections.mysql.password');

        if ($database === '') {
            $this->error('DB_DATABASE não está definido no .env');

            return self::FAILURE;
        }

        $this->info("A ligar a {$host}:{$port} como {$username}…");

        $dsnNoDb = sprintf('mysql:host=%s;port=%d;charset=utf8mb4', $host, $port);

        try {
            $pdo = new PDO($dsnNoDb, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_MULTI_STATEMENTS => true,
            ]);
        } catch (PDOException $e) {
            $this->error('Falha na ligação: '.$e->getMessage());

            return self::FAILURE;
        }

        $dbEsc = str_replace('`', '``', $database);
        $this->warn("A eliminar e recriar a base `{$database}`…");
        $pdo->exec("DROP DATABASE IF EXISTS `{$dbEsc}`");
        $pdo->exec("CREATE DATABASE `{$dbEsc}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

        $pdo->exec("USE `{$dbEsc}`");

        $this->info('A ler o ficheiro SQL…');
        $sql = file_get_contents($path);
        if ($sql === false) {
            $this->error('Não foi possível ler o ficheiro.');

            return self::FAILURE;
        }

        $this->info('A importar (pode demorar vários minutos)…');

        try {
            $pdo->exec($sql);
        } catch (PDOException $e) {
            $this->error('Erro durante import: '.$e->getMessage());

            return self::FAILURE;
        }

        $this->info('Importação concluída com sucesso.');

        return self::SUCCESS;
    }
}
