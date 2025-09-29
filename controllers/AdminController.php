<?php
require_once(__DIR__ . "/Controller.php");

class AdminController extends Controller
{
    public function runMigrations()
    {
        try {
            $files = scandir(__DIR__ . '/../migrations');

            foreach ($files as $file) {
                if ($file === '.' || $file === '..')
                    continue;

                require_once(__DIR__ . '/../migrations/' . $file);
            }

            echo $this->okResponse([
                'message' => 'Migrations ran successfully'
            ]);
        } catch (\Throwable $th) {
            echo $this->internalErrResponse([
                'message' => 'Could not read file directory',
                'error' => $th->getMessage(),
            ]);
        }
    }
}