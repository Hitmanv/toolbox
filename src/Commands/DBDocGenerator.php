<?php

namespace Hitman\Toolbox\Commands;

use DB;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class DBDocGenerator extends Command
{
    protected $signature = 'tb:db_doc';
    protected $description = '数据库文档生成';
    protected $file;

    public function __construct(Filesystem $file)
    {
        parent::__construct();
        $this->file = $file;
    }
    public function handle()
    {
        $database = env('DB_DATABASE', 'forge');
        $field = 'Tables_in_' . $database;
        $tables = collect(DB::select('show tables'))->map(function ($t) use ($field) {
            return $t->$field;
        })->filter(function ($name) {
            return $name != 'migrations';
        });
        $doc = '';
        $tables->each(function ($t) use (&$doc){
            $meta = DB::select("show full fields from $t");
            // Table Header
            $head = "## ". $t . "\n";
            $head .= "字段 | 字段类型 | 字段说明\n";
            $head .= "--- | --- | ---\n";
            // table body
            $d = collect($meta)->map(function($m){
                return "{$m->Field} | {$m->Type} | {$m->Comment}";
            })->implode("\n");
            $doc .= $head . $d . "\n\n";
        });
        $path = base_path() . "/docs/db.md";
        $this->makeDirectory($path);
        $this->file->put($path, $doc);
        $this->info($doc);
    }
    protected function makeDirectory($path)
    {
        if (!$this->file->isDirectory(dirname($path))) {
            $this->file->makeDirectory(dirname($path), 0777, true, true);
        }
    }
}