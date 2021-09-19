<?php
try {
            $filePath=_DIR_.'/config.json';
            $configfile = fopen($filePath, 'r');
            $config= json_decode(fread($configfile, filesize($filePath)));

            $pdo = new \PDO('mysql:host='.$config->host.';dbname='.$config->dbname.';charset=utf8', $config->user, $config->pass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
            $this->pdo=$pdo;

        } catch
        (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }