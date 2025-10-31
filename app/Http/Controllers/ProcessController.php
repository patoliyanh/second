<?php

namespace App\Http\Controllers;

use App\Contracts\LoggerInterface;
use App\Services\CustomLogger;
use Illuminate\Http\Request;
use Illuminate\Process\Pool;
use Illuminate\Support\Facades\Process;

class ProcessController extends Controller
{
    protected $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger=$logger;
    }
    public function runExample()
    {

        //***this are synchronous

        // $result=Process::run('ls -la');
        // if($result->successful()){
        //     return response()->json([
        //       'message'=>'Command executed successfully',
        //       'output'=>$result->output(),
        //     ]);

        // }else{
        //     return response()->json([
        //        'message'=>'command Fail',
        //        'error'=>$result->errorOutput(),
        //     ],500);
        // }

        //***this is using pipeline

        // $result=Process::pipe([
        //   'echo "Hello World!"',
        //   'tr "[:lower:]" "[:upper:]"',
        //   'rev',
        // ]);
        // echo $result->output();

        // $results = Process::pool(function (Pool $pool) {
        //     $pool->command('php artisan cache:clear')->as('cache');
        //     $pool->command('php artisan config:cache')->as('config');
        // })->wait();

        // echo $results['cache']->output();
        // echo $results['config']->output();
    }
    //*** this are for the asynchronous */
    public function runSingleAsync()
    {
        $process = Process::start('php artisan schedule:run');
        return response()->json([
            'message' => 'Background process started successfully',
        ]);
    }
    public function runMultipleAsync()
    {
        Process::pool(function (Pool $pool) {
            $pool->command('php artisan cache:clear');
            $pool->command('php artisan config:cache');
            $pool->command('php artisan route:cache');
        })->start(function (string $type, string $output, string $key) {
            info("[$key][$type] $output");
        });

        return response()->json([
            'message' => 'Multiple background processes started successfully!',
        ]);
    }
    public function index(){
       $this->logger->log('User visited index page');
    }
    public function collection(){
        $collection=collect([1,2,3,4,5]);
        $filtered=$collection->filter(function ($value){
           return $value >2;
        });
        $filtered->all();
    }
}
